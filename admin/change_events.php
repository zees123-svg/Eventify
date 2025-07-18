<?php
include 'common/header.php';
include 'common/sidebar.php';
include 'DB/Connection.php';

if (!isset($_GET['id'])) {
    echo "No event ID provided.";
    exit;
}

$event_id = $_GET['id'];

// Fetch venues for tab
$stmt = $conn->prepare("SELECT * FROM event WHERE id = :id");
$stmt->bindParam(':id', $event_id, PDO::PARAM_INT);
$stmt->execute();
$events = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$events) {
    die("Event not found.");
}

if (isset($_POST['submit'])) {
    $tab_number = $_REQUEST['tab_number'];
    $name = $_REQUEST['event_name'];
    $menu = $_REQUEST['event_menu'];
    $location = $_REQUEST['location'];
    $total_persons = $_REQUEST['total_persons'];
    $shift = $_REQUEST['shift'];
    $updated_at = date('Y-m-d H:i:s');

    $uploadDir = './dist/assets/';
    $image = $events['img'];

    if (!empty($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['error'] === 0) {
        $fileName = basename($_FILES['fileToUpload']['name']);
        $fileName = preg_replace('/[^A-Za-z0-9.\-_]/', '_', $fileName);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
            $image = $fileName;
        } else {
            echo "<script>alert('Image upload failed.');</script>";
        }
    }

    $details = $_POST['details'] ?? '';

$stmt = $conn->prepare("UPDATE event SET  tab_number = ?, img = ?, event_name = ?, event_menu = ?, location = ?, total_persons = ?, shift = ?, updated_at = ?, details = ? WHERE id = ?");
$stmt->execute([$tab_number, $image, $name, $menu, $location, $total_persons, $shift, $updated_at, $details, $event_id]);

    echo "<script>alert('Event updated successfully.'); window.location.href='events.php';</script>";
    exit;
}

?>

<!-- Main content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Change Event</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Events</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Center column -->
                <div class="col-md-12 mx-auto">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Event</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control" id="tab_number" name="tab_number">
                                        <option value="1" <?= $events['tab_number'] == '1' ? 'selected' : '' ?>>Tab 1</option>
                                        <option value="2" <?= $events['tab_number'] == '2' ? 'selected' : '' ?>>Tab 2</option>
                                    </select>                                
                                </div>
                                <div class="form-group">
                                    <label for="Event">Event name</label>
                                    <input type="text" class="form-control" id="Event" value="<?php echo htmlspecialchars($events['event_name']) ?>" name="event_name" placeholder="Enter Event Name">
                                </div>
                                <div class="form-group">
                                    <label for="Event">Event menu</label>
                                    <input type="text" class="form-control" id="Event" value="<?php echo htmlspecialchars($events['event_menu']) ?>" name="event_menu" placeholder="Enter Event Menu">
                                </div>
                                <div class="form-group">
                                 <label for="location">Event Location</label>
                                <input type="text" class="form-control" id="location" value="<?php echo htmlspecialchars($events['location']) ?>" name="location" placeholder="Enter Event Location">
                                </div>
                                <div class="form-group">
                                    <label for="total_persons">Total Persons</label>
                                    <input type="number" class="form-control" value="<?php echo htmlspecialchars($events['total_persons']) ?>" name="total_persons" placeholder="Enter number of persons">
                                </div>
                                <div class="form-group">
                                    <label for="shift">Shift</label>
                                      <select class="form-control" name="shift">
                                        <option value="Morning" <?= $events['shift'] == 'Morning' ? 'selected' : '' ?>>Morning</option>
                                        <option value="Evening" <?= $events['shift'] == 'Evening' ? 'selected' : '' ?>>Evening</option>
                                        <option value="Night" <?= $events['shift'] == 'Night' ? 'selected' : '' ?>>Night</option>
                                      </select>
                                </div>
                                <div class="form-group">
                                <label for="fileToUpload">Main Image</label>
                                <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
                                <?php if (!empty($events['img'])): ?>
                                <p>Current Image:</p>
                                <img src="./dist/assets/<?= htmlspecialchars($events['img']) ?>" width="200" />
                                <?php endif; ?>
                                </div>
                                <section class="content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-outline card-info">
                                                <div class="card-header">
                                                    <h3 class="card-title">
                                                        Note
                                                    </h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <textarea id="summernote" name="details">
                                                        <?= $events['details'] ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.col-->
                                    </div>
                                    <!-- /.row -->
                                </section>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer col text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Updated</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
<?php
    include 'common/footer.php';
?>
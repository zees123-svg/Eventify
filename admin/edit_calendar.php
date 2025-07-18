<?php
include 'common/header.php';
include 'common/sidebar.php';
include 'DB/Connection.php';

if (!isset($_GET['id'])) {
    echo "No calendar ID provided.";
    exit;
}

$calendar_id = $_GET['id'];

// Fetch venues for tab
$stmt = $conn->prepare("SELECT * FROM calendar WHERE id = :id");
$stmt->bindParam(':id', $calendar_id, PDO::PARAM_INT);
$stmt->execute();
$calendars = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$calendars) {
    die("Calendar not found.");
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $updated_at = date('Y-m-d H:i:s');

$stmt = $conn->prepare("UPDATE calendar SET title = ?, start = ?, end = ?, updated_at = ? WHERE id = ?");
$stmt->execute([$title, $start, $end, $updated_at, $calendar_id]);

    echo "<script>alert('Calendar updated successfully.'); window.location.href='calendars.php';</script>";
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
                    <h1 class="m-0">Change Calendar</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Calendars</li>
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
                            <h3 class="card-title">Edit Calendar</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" value="<?php echo htmlspecialchars($calendars['title']) ?>" name="title" placeholder="Enter Title">
                                </div>
                                <div class="form-group">
                                    <label for="start">Event Start</label>
                                    <input type="datetime-local" class="form-control" id="start" value="<?php echo htmlspecialchars($calendars['start']) ?>" name="start">
                                </div>
                                <div class="form-group">
                                 <label for="end">Event End</label>
                                <input type="datetime-local" class="form-control" id="end" value="<?php echo htmlspecialchars($calendars['end']) ?>" name="end">
                                </div>
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
    include './common/footer.php';
?>
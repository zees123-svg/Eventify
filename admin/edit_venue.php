<?php
include 'common/header.php';
include 'common/sidebar.php';
include 'DB/Connection.php';

if (!isset($_GET['id'])) {
    echo "No venue ID provided.";
    exit;
}

$venue_id = $_GET['id'];

// Fetch venues for tab
$stmt = $conn->prepare("SELECT * FROM venue WHERE id = :id");
$stmt->bindParam(':id', $venue_id, PDO::PARAM_INT);
$stmt->execute();
$venues = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$venues) {
    die("Venue not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tab_number = $_POST['tab_number'] ?? 0;
    $venue_name = $_POST['venue_name'] ?? '';
    $detail = $_POST['detail'] ?? '';
    $location = $_POST['location'] ?? '';
    $price_display = $_POST['price_display'] ?? '';
    $total_capacity = $_POST['total_capacity'] ?? 0;
    $updated_at = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("UPDATE venue 
        SET tab_number = ?, venue_name = ?, detail = ?, location = ?, price_display = ?, total_capacity = ?, updated_at = ? 
        WHERE id = ?");
    $stmt->execute([
    $tab_number, $venue_name, $detail, $location, $price_display, $total_capacity, $updated_at, $venue_id
    ]);


    echo "<script>alert('Venue updated successfully.'); window.location.href='venue.php';</script>";
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
                    <h1 class="m-0">Change Venue</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Venues</li>
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
                            <h3 class="card-title">Edit Venue</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control" id="tab_number" name="tab_number">
                                        <option value="1" <?= $venues['tab_number'] == '1' ? 'selected' : '' ?>>Tab 1</option>
                                        <option value="2" <?= $venues['tab_number'] == '2' ? 'selected' : '' ?>>Tab 2</option>
                                        <option value="3" <?= $venues['tab_number'] == '3' ? 'selected' : '' ?>>Tab 3</option>
                                    </select>                                
                                </div>
                                <div class="form-group">
                                    <label for="venue_name">Venue Name</label>
                                    <input type="text" class="form-control" id="venue_name" value="<?php echo $venues['venue_name'] ?>" name="venue_name" placeholder="Enter Venue Name">
                                </div>
                                <div class="form-group">
                                    <label for="detail">Short Description</label>
                                    <textarea class="form-control" name="detail" rows="3"><?= htmlspecialchars($venues['detail']) ?></textarea>
                                </div>    
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" value="<?php echo $venues['location'] ?>" name="location" placeholder="Enter Venue Location">
                                </div>
                                <div class="form-group">
                                    <label for="price_display">Price Display</label>
                                    <input type="text" class="form-control" id="price_display" value="<?php echo $venues['price_display'] ?>" name="price_display" placeholder="Enter Price">
                                </div>   
                                <div class="form-group">
                                    <label for="total_capacity">Total Capacity</label>
                                    <input type="number" class="form-control" id="total_capacity" value="<?php echo $venues['total_capacity'] ?>" name="total_capacity" placeholder="Enter Total Capacity">
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
    include 'common/footer.php';
?>
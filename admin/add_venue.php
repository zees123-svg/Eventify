<?php
include 'common/header.php';
include 'common/sidebar.php';
include 'DB/Connection.php';

if (isset($_POST['submit'])) {
    $tab_number = $_POST['tab_number'];
    $venue_name = $_POST['venue_name'];
    $detail = $_POST['detail'];
    $location = $_POST['location'];
    $price_display = $_POST['price_display'];
    $total_capacity = $_POST['total_capacity'];

    try {
        $sql = "INSERT INTO venue (tab_number,venue_name, detail, location, price_display, total_capacity)
                VALUES (:tab_number, :venue_name, :detail, :location, :price_display, :total_capacity)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':tab_number' => $tab_number,
            ':venue_name' => $venue_name,
            ':detail' => $detail,
            ':location' => $location,
            ':price_display' => $price_display,
            ':total_capacity' => $total_capacity
        ]);

        echo "<script>
            alert('Venue has been added successfully!');
            window.location.href='venue.php'; 
        </script>";
        exit;
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
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
                    <h1 class="m-0">Add New Venue</h1>
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
            <div class="col-md-3"></div>
                <!-- Center column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">New Venue form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="add_venue.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tab_number">Tab Number</label>
                                    <select class="form-control" id="tab_number" name="tab_number">
                                        <option value="1">Tab 1</option>
                                        <option value="2">Tab 2</option>
                                        <option value="3">Tab 3</option>
                                    </select> 
                                </div>    
                                <div class="form-group">
                                    <label for="venue_name">Venue Name</label>
                                    <input type="text" class="form-control" id="venue_name" name="venue_name" placeholder="Enter Venue Name">
                                </div>
                                <div class="form-group">
                                    <label for="detail">Detail</label>
                                    <textarea class="form-control" name="detail" cols=40 rows=3>Short Desc</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter Venue Location">
                                </div>
                                <div class="form-group">
                                    <label for="price_display">Price Display</label>
                                    <input type="text" class="form-control" id="price_display" name="price_display" placeholder="Enter Price">
                                </div>    
                                <div class="form-group">
                                    <label for="total_capacity">Total Capacity</label>
                                    <input type="number" class="form-control" id="total_capacity" name="total_capacity" placeholder="Enter Total Capacity">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer col text-center">
                            <button type="submit" name="submit" class="btn btn-primary mx-auto">Add New Venue</button>
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
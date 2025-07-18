<?php

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

include 'common/header.php';
include 'common/sidebar.php'; 
include 'DB/Connection.php';

try {
    $stmt = $conn->prepare("SELECT * FROM venue ORDER BY created_at DESC");
    $stmt->execute();
    $venues = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $venues = []; 
}
    
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
    
        $stmt = $conn->prepare("DELETE FROM venue WHERE id = :id");
        $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
        $stmt->execute();
    
        echo "<script>
            alert('venue deleted successfully.');
            window.location.href = 'venue.php';
        </script>";
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
                    <h1 class="m-0">Venue</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Venue</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h3 class="card-title"></h3> -->
                            <div class="clearfix">
                                <span class="float-left">
                                    <h3 class="card-title">Venue Table</h3>
                                </span>
                                <span class="float-right">
                                    <form action="add_venue.php" method="POST"><input type="hidden" name="id" value=''>
                                        <input type="submit" value="Add new venue" name="edit" class="btn btn-sm btn-primary">
                                    </form>
                                </span>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                   <tr>
                                       <th>ID</th>
                                       <th>Tab Number</th>
                                       <th>Price Display</th>
                                       <th>Total Capacity</th>
                                       <th>Created</th>
                                       <th>Updated</th>
                                       <th>Action</th>
                                       <th>Action</th>
                                       <th>Action</th>
                                    </tr>
                                </thead>
  <tbody>
  <?php foreach ($venues as $venue): ?>
    <tr>
        <td><?= $venue['id']; ?></td>
        <td><?= $venue['tab_number']; ?></td>
        <td><?= $venue['price_display']; ?></td>
        <td><?= $venue['total_capacity']; ?></td>
        <td><?= $venue['created_at']; ?></td>
        <td><?= $venue['updated_at']; ?></td>

        <td><a href="venue_details.php?id=<?= $venue['id']; ?>" class="btn btn-sm btn-primary">View</a></td>
        <td><a href="edit_venue.php?id=<?= $venue['id']; ?>" class="btn btn-sm btn-success">Edit</a></td>
        <td><a href="?delete_id=<?= $venue['id']; ?>"  class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this venue?')">Delete</a></td>
      </tr>
      <?php endforeach ?>
  </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
<?php
include 'common/footer.php';
?>
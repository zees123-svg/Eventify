<?php

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
} 
ob_start(); 
include 'common/header.php';
include 'common/sidebar.php'; 
include 'DB/Connection.php';

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM subscribe WHERE id = :id");
    $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: subscribe.php");
        exit;
    } else {
        echo "<script>alert('Failed to delete the subscribe.');</script>";
    }
}


$stmt = $conn->prepare("SELECT * FROM subscribe ORDER BY created_at DESC");
$stmt->execute();
$subscribes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Main content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Subscribe</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Subscribe</li>
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
                                    <h3 class="card-title">Subscribe Table</h3>
                                </span>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                   <tr>
                                       <th>ID</th>
                                       <th>Email</th>
                                       <th>Created At</th>
                                       <th>Action</th>
                                    </tr>
                                </thead>
  <tbody>
  <?php foreach ($subscribes as $subscribe): ?>
    <tr>
        <td><?= $subscribe['id']; ?></td>
        <td><?= $subscribe['email']; ?></td>
        <td><?= $subscribe['created_at']; ?></td>
  
        <td><a href="?delete_id=<?= $subscribe['id']; ?>"  class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this subscribe?')">Delete</a></td>
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
ob_end_flush();
?> 
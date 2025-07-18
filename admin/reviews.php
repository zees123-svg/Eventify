<?php

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
} 

include './common/header.php';
include './common/sidebar.php';
include 'DB/Connection.php';
   if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM review WHERE id = :id");
    $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: reviews.php");
        exit;
    } else {
        echo "<script>alert('Failed to delete the Review.');</script>";
    }
}

$stmt = $conn->prepare("SELECT * FROM review ORDER BY created_at DESC");
$stmt->execute();
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Main content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reviews</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reviews</li>
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
                            <div class="clearfix">
                                <span class="float-left">
                                    <h3 class="card-title">Reviews Table</h3>
                                </span>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Rating</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($reviews as $review): ?>
    <tr>
        <td><?= $review['id']; ?></td>
        <td><?= $review['name']; ?></td>
        <td><?= $review['rating']; ?></td>
        <td><?= $review['created_at']; ?></td>
        <td><a href="reviews_details.php?id=<?= $review['id']; ?>" class="btn btn-sm btn-primary">View</a></td>
        <td><a href="?delete_id=<?= $review['id']; ?>"  class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this review?')">Delete</a></td>
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

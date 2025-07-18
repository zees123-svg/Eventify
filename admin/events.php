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
    $stmt = $conn->prepare("SELECT * FROM event ORDER BY id DESC");
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $events = []; 
}
   /*  if ($conn) {
    $stmt = $conn->prepare("SELECT * FROM `event` ORDER BY id DESC");
	$stmt->execute();
	$test = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } else {
        echo "Connection failed.";
    } */
    
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
    
        $stmt = $conn->prepare("DELETE FROM `event` WHERE id = :id");
        $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
        $stmt->execute();
    
        echo "<script>
            alert('event deleted successfully.');
            window.location.href = 'events.php';
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
                    <h1 class="m-0">Main Events</h1>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h3 class="card-title"></h3> -->
                            <div class="clearfix">
                                <span class="float-left">
                                    <h3 class="card-title">Events Table</h3>
                                </span>
                                <span class="float-right">
                                    <form action="add_events.php" method="POST"><input type="hidden" name="id" value=''>
                                        <input type="submit" value="Add new events" name="edit" class="btn btn-sm btn-primary">
                                    </form>
                                </span>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Tab Number</th>
                                        <th>Location</th>
                                        <th>Total_persons</th>
                                        <th>Shift</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
  <tbody>
  <?php foreach ($events as $event): ?>
    <tr>
        <td><?= $event['id']; ?></td>
        <td><?= $event['tab_number']; ?></td>
        <td><?= $event['location']; ?></td>
        <td><?= $event['total_persons']; ?></td>
        <td><?= $event['shift']; ?></td>
        <td><?= $event['created_at']; ?></td>
        <td><?= $event['updated_at']; ?></td>
        <td><a href="events_details.php?id=<?= $event['id']; ?>" class="btn btn-sm btn-primary">view</a></td>
        <td><a href="change_events.php?id=<?= $event['id']; ?>" class="btn btn-sm btn-success">Edit</a></td>
        <td><a href="?delete_id=<?= $event['id']; ?>"  class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this event?')">Delete</a></td>
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
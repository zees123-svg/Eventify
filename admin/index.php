<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include 'common/header.php';
include 'common/sidebar.php';
include 'DB/Connection.php';

$sql1 = "
    SELECT
        
        COUNT(*) AS total_bookings,
        SUM(CASE WHEN created_at >= CURDATE() - INTERVAL 7 DAY THEN 1 ELSE 0 END) AS new_bookings,
        SUM(CASE WHEN created_at < CURDATE() - INTERVAL 7 DAY THEN 1 ELSE 0 END) AS old_bookings,
        SUM(CASE WHEN updated_at IS NOT NULL AND updated_at > created_at THEN 1 ELSE 0 END) AS changed_bookings
        
    FROM bookings
";

    // Execute query
    $stmt1 = $conn->query($sql1);
    $result = $stmt1->fetch();

$sql2 = "
SELECT 
  id, 
  name, 
  event_type, 
  start_time 
FROM bookings
ORDER BY created_at DESC
";

$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<!-- Main content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                     <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 class="text-white"><?php echo $result['total_bookings']; ?></h3>

                            <p class="text-white">Total Bookings</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                    <!-- small box -->
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $result['new_bookings']; ?></h3>

                            <p>New Bookings</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                 <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $result['old_bookings']; ?></h3>

                            <p>Old Bookings</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clock"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                 <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $result['changed_bookings']; ?></h3>

                            <p>Changed Bookings</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-loop"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#id</th>
                                        <th>User Name</th>
                                        <th>Event Title</th>
                                        <th>Booking Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($rows)): ?>
                                        <?php foreach ($rows as $row): ?>
                                            <tr>
                                                <td><?= $row['id'] ?></td>
                                                <td><?= htmlspecialchars($row['name']) ?></td>
                                                <td><?= htmlspecialchars($row['event_type']) ?></td>
                                                <td><?= date('d M Y, h:i A', strtotime($row['start_time'])) ?></td>
                                            </tr>    
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr><td colspan="4">No bookings found.</td></tr>
                                    <?php endif; ?>
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
include 'common/footer.php'
?>
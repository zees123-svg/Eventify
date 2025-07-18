<?php
include 'common/header.php';
include 'common/sidebar.php';
include 'DB/Connection.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid ID.");
}

$stmt = $conn->prepare('SELECT * FROM venue WHERE id = :id');
$stmt->execute([':id' => $id]);
$cat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cat) {
    die("Venue not found.");
}

?>

<!-- Main Content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Venue</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Venue Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <!-- General form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Venue Details</h3>
                        </div>

                        <!-- Form Start -->
<div class="card-body">
    <div class="form-group">
        <label>Venue Name:</label>
        <p><?= htmlspecialchars($cat['venue_name']) ?></p>
    </div>
    <div class="form-group">
        <label>Detail:</label>
        <div><?= $cat['detail'] ?></div>
    </div>
    <div class="form-group">
        <label>Location:</label>
        <p><?= htmlspecialchars($cat['location']) ?></p>
    </div>
</div>


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
<?php
include("./common/header.php");    
include("../admin/DB/Connection.php"); 

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid or missing event ID.");
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM event WHERE id = :id");
$stmt->execute([':id' => $id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    die("Event not found.");
}
?>

<!-- ***** About Us Page ***** -->
<div class="page-heading-shows-events">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Event Details</h2>
                <span>Check out our latest Shows & Events and be part of us.</span>
            </div>
        </div>
    </div>
</div>

<div class="shows-events-schedule">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Event Listing</h2>
                </div>
                <div class="container">
                    <h2><?= htmlspecialchars($event['event_name']) ?></h2>
                    <h5><strong>Menu:</strong> <?= htmlspecialchars($event['event_menu']) ?></h5>
                    <h5><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></h5>
                    <h5><strong>Total Persons:</strong> <?= (int)$event['total_persons'] ?></h5>
                    <h5><strong>Shift:</strong> <?= htmlspecialchars($event['shift']) ?></h5>
                    <img src="../admin/dist/assets/<?= htmlspecialchars($event['img']) ?>" width="100%" alt="Event Image" class="img-fluid mb-3" />
                    <div class="content">
                        <?= ($event['details']) ?>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</div>

<?php include("./common/footer.php"); ?>

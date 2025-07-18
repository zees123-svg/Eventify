<?php
include("./common/header.php");  
include("../admin/DB/Connection.php");

$stmt = $conn->prepare("SELECT * FROM calendar ORDER BY start ASC");
$stmt->execute();
$calendars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!--  Event Table -->
<div class="container mt-5">
  <h2 class="mb-3 text-dark">Event Schedule Table</h2>
  <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
      <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Last Updated</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($calendars)): $i = 1; ?>
          <?php foreach ($calendars as $event): ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= htmlspecialchars($event['title']) ?></td>
              <td><?= date('d M Y, h:i A', strtotime($event['start'])) ?></td>
              <td><?= date('d M Y, h:i A', strtotime($event['end'])) ?></td>
              <td><?= date('d M Y, h:i A', strtotime($event['updated_at'])) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="5" class="text-center">No events found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php

include("./common/footer.php");    

?>  
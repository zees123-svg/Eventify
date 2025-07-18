<?php
include("../admin/DB/Connection.php");

header('Content-Type: application/json');

try {
    $stmt = $conn->prepare("SELECT id, title, start, end FROM calendar");
    $stmt->execute();
    $events = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $events[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'start' => $row['start'],
            'end' => $row['end'],
        ];
    }

    echo json_encode($events);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>


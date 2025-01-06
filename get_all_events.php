<?php
include 'db_connection.php';

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT e.id, e.name, e.description, e.event_date, e.location, e.capacity, 
               (e.capacity - IFNULL(COUNT(r.id), 0)) AS remaining_slots 
        FROM events e 
        LEFT JOIN registrations r ON e.id = r.event_id
        WHERE (e.name LIKE ? OR e.location LIKE ?) 
        AND e.status = 'Active' AND e.event_date >= NOW() 
        GROUP BY e.id
        ORDER BY e.event_date ASC   -- Order by nearest date to event
        LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error: " . $conn->error);
}

$searchTerm = "%$search%";
$stmt->bind_param("ssii", $searchTerm, $searchTerm, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
} else {
    $events = [];
}

$totalEventsSql = "SELECT COUNT(*) AS total 
                   FROM events 
                   WHERE (name LIKE ? OR location LIKE ?) 
                   AND status = 'Active' AND event_date >= NOW()";

$totalStmt = $conn->prepare($totalEventsSql);
if ($totalStmt === false) {
    die("Error: " . $conn->error);
}

$totalStmt->bind_param("ss", $searchTerm, $searchTerm);
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalRow = $totalResult->fetch_assoc();
$totalEvents = $totalRow['total'];
$totalPages = ceil($totalEvents / $limit); 

$conn->close();

echo json_encode([
    'events' => $events,
    'totalPages' => $totalPages,
    'currentPage' => $page
]);
?>

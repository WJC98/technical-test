<?php
include 'db_connection.php'; 

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 5;

$start = ($page - 1) * $perPage;

$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

$baseQuery = "SELECT * FROM events";
$whereClause = "";
$orderClause = " ORDER BY FIELD(status, 'Active') DESC, event_date ASC";
$limitClause = " LIMIT ?, ?";

if (!empty($searchQuery)) {
    $whereClause = " WHERE name LIKE ? OR location LIKE ? OR description LIKE ?";
}

$finalQuery = $baseQuery . $whereClause . $orderClause . $limitClause;

$stmt = $conn->prepare($finalQuery);

if (!empty($searchQuery)) {
    $searchTerm = "%" . $searchQuery . "%";
    $stmt->bind_param("sssii", $searchTerm, $searchTerm, $searchTerm, $start, $perPage);
} else {
    $stmt->bind_param("ii", $start, $perPage);
}

$stmt->execute();
$result = $stmt->get_result();

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

$totalQuery = "SELECT COUNT(*) as total FROM events";
if (!empty($searchQuery)) {
    $totalQuery .= " WHERE name LIKE ? OR location LIKE ? OR description LIKE ?";
    $stmtTotal = $conn->prepare($totalQuery);
    $stmtTotal->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
} else {
    $stmtTotal = $conn->prepare($totalQuery);
}

$stmtTotal->execute();
$totalResult = $stmtTotal->get_result();
$totalRow = $totalResult->fetch_assoc();
$totalEvents = $totalRow['total'];

echo json_encode([
    'data' => $events,
    'total' => $totalEvents
]);

$stmt->close();
$stmtTotal->close();
$conn->close();
?>

<?php
include 'db_connection.php';

$email = $_GET['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['message' => 'Invalid email format.']);
    exit;
}

$sql = "
    SELECT e.id, e.name, e.description, e.event_date, e.location
    FROM events e
    JOIN registrations r ON e.id = r.event_id
    WHERE r.email = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$registeredEvents = [];
while ($row = $result->fetch_assoc()) {
    $registeredEvents[] = $row;
}

$conn->close();

echo json_encode($registeredEvents);
?>

<?php
include 'db_connection.php';

$eventId = $_POST['eventId'];
$name = $_POST['name'];
$email = $_POST['email'];

$sql = "SELECT id, name, capacity, remaining_slots FROM events WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $eventId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(['message' => 'Event not found.']);
    exit;
}

$event = $result->fetch_assoc();

if ($event['remaining_slots'] <= 0) {
    echo json_encode(['message' => 'Event is fully booked.']);
    exit;
}

$sql = "SELECT * FROM registrations WHERE event_id = ? AND email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $eventId, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['message' => 'This email is already registered for the event.']);
    exit;
}

$sql = "INSERT INTO registrations (event_id, name, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $eventId, $name, $email);

if ($stmt->execute()) {
    $newRemainingSlots = $event['remaining_slots'] - 1;
    $updateSql = "UPDATE events SET remaining_slots = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ii", $newRemainingSlots, $eventId);
    $updateStmt->execute();

    echo json_encode(['message' => 'Registration successful.']);
} else {
    echo json_encode(['message' => 'Registration failed. Please try again later.']);
}

$conn->close();
?>

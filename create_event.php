<?php
include 'db_connection.php';

$name = $_POST['name'];
$description = $_POST['description'];
$event_date = $_POST['event_date'];
$location = $_POST['location'];
$capacity = $_POST['capacity'];
$status = $_POST['status'];

$remaining_slots = $capacity;

$sql = "INSERT INTO events (name, description, event_date, location, capacity, status, remaining_slots)
VALUES ('$name', '$description', '$event_date', '$location', '$capacity', '$status', '$remaining_slots')";

if ($conn->query($sql) === TRUE) {
    echo 'success';
} else {
    echo 'error';
}
?>

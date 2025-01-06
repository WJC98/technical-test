<?php
include 'db_connection.php';

$id = $_POST['id'];

$sql = "DELETE FROM events WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo 'success';
} else {
    echo 'error';
}
?>

<?php
$servername = "fdb1028.awardspace.net";
$username = "4352975_cwj";
$password = "wjtest123";
$dbname = "4352975_cwj";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

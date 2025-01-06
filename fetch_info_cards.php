<?php
include 'db_connection.php';

$query = "
    SELECT 
        COUNT(*) AS total_events,
        SUM(CASE WHEN status = 'Active' THEN 1 ELSE 0 END) AS active_events,
        SUM(CASE WHEN status = 'Completed' THEN 1 ELSE 0 END) AS completed_events
    FROM events
";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

echo json_encode([
    'total_events' => $row['total_events'],
    'active_events' => $row['active_events'],
    'completed_events' => $row['completed_events']
]);

mysqli_close($conn);
?>

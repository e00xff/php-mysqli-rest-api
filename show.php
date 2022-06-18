<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents("php://input"), true);
$studentId = $data['student_id'] ?? false;

// http://127.0.0.1:8000/show.php?student_id=2
// $studentId = $_GET['student_id'] ?? false;

include 'config.php';

$sql = "SELECT * FROM student WHERE student_id = '{$studentId}'";
$result = mysqli_query($conn, $sql) or die('Query Error: '.mysqli_error($conn));

if(mysqli_num_rows($result) > 0) {
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
} else {
    echo json_encode([
        'message' => 'No Record Found',
        'status' => false
    ]);
}

?>
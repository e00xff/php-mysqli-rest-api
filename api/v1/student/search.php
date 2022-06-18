<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// http://127.0.0.1:8000/search.php
//$data = json_decode(file_get_contents("php://input"), true);
//$searchValue = $data['search'] ?? false;

// http://127.0.0.1:8000/search.php?search=Levan
$searchValue = isset($_GET['search']) ? $_GET['search'] : die();

include '../../../config.php';

$sql = "SELECT * FROM student WHERE student_name LIKE '%{$searchValue}%'";
$result = mysqli_query($conn, $sql) or die('Query Error: '.mysqli_error($conn));

if(mysqli_num_rows($result) > 0) {
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
} else {
    echo json_encode([
        'message' => 'No Search Found',
        'status' => false
    ]);
}

?>
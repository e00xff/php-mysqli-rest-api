<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

$studentName = $data['student_name'] ?? false;
$studentAddress = $data['student_address'] ?? false;
$studentPhone = $data['student_phone'] ?? false;

include '../../../config.php';

$sql = "INSERT INTO `student` (`student_name`, `student_address`, `student_phone`) 
        VALUES ('$studentName', '$studentAddress', '$studentPhone');";
$result = mysqli_query($conn, $sql) or die('Query Error: '.mysqli_error($conn));

if($result) {
    echo json_encode([
        'message' => 'Student Record Inserted.',
        'status' => true
    ]);
} else {
    echo json_encode([
        'message' => 'Student Record Not Inserted.',
        'status' => false
    ]);
}

?>
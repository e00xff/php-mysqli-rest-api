<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

$studentId = $data['student_id'] ?? false;
$studentName = $data['student_name'] ?? false;
$studentAddress = $data['student_address'] ?? false;
$studentPhone = $data['student_phone'] ?? false;

include '../../../config.php';

$sql = "DELETE FROM student WHERE `student`.`student_id` = '{$studentId}'";
$result = mysqli_query($conn, $sql) or die('Query Error: '.mysqli_error($conn));

if($result) {
    echo json_encode([
        'message' => 'Student Record Deleted.',
        'status' => true
    ]);
} else {
    echo json_encode([
        'message' => 'Student Record Not Deleted.',
        'status' => false
    ]);
}

?>
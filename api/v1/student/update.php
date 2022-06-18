<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

$studentId = $data['student_id'] ?? false;
$studentName = $data['student_name'] ?? false;
$studentAddress = $data['student_address'] ?? false;
$studentPhone = $data['student_phone'] ?? false;

include '../../../config.php';

$sql = "UPDATE `student` 
            SET `student_name` = '$studentName', 
                `student_address` = '$studentAddress', 
                `student_phone` = '$studentPhone' 
        WHERE `student`.`student_id` = {$studentId}";
$result = mysqli_query($conn, $sql) or die('Query Error: '.mysqli_error($conn));

if($result) {
    echo json_encode([
        'message' => 'Student Record Updated.',
        'status' => true
    ]);
} else {
    echo json_encode([
        'message' => 'Student Record Not Updated.',
        'status' => false
    ]);
}

?>
<?php

$hostname = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'db_students';

$conn = mysqli_connect($hostname, $username, $password, $database) or die('Query Error: '.mysqli_connect_error($conn));

?>
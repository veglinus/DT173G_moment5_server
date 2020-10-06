<?php

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    die;
}

include_once 'includes/courses.class.php';
include 'includes/connect.php';

$course = new Courses();
$result = $course->getCourses();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, Content-Type");
/*
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
*/

header('Content-Type: application/json'); 
echo json_encode($result);


?>
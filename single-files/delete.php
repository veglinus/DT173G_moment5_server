<?php

/*
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    die;
}*/

include_once 'includes/courses.class.php';
include 'includes/connect.php';

$data = json_decode(file_get_contents('php://input'), true);

$course = new Courses();
$result = $course->deleteCourse($data['code']);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header('Content-Type: application/json'); 

echo json_encode($result);

?>
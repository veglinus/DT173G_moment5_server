<?php
/*
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    die;
}

include_once 'includes/courses.class.php';
include 'includes/connect.php';

parse_str(file_get_contents('php://input'), $data);

$course = new Courses();
$result = $course->editCourse($data['index'], $data['code'], $data['name'], $data['progression'], $data['syllabus']);
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json'); 
echo json_encode($result);
*/
?>
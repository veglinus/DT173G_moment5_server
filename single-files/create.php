<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die;
}

include_once 'includes/courses.class.php';
include 'includes/connect.php';

$course = new Courses();
$result = $course->addCourse($_POST['code'], $_POST['name'], $_POST['progression'], $_POST['syllabus']);
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json'); 
echo json_encode($result);

?>
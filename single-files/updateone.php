<?php

/*
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    die;
}*/ 

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Accept, Content-Type");
    header("Access-Control-Allow-Methods: PUT");
    header('Content-Type: application/json'); 
    http_response_code(204);
} else {

include_once 'includes/courses.class.php';
include 'includes/connect.php';

$data = json_decode(file_get_contents('php://input'), true);

$course = new Courses();
$result = $course->editOne($data['index'], $data['what'], $data['newvalue']);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Accept, Content-Type");
header("Access-Control-Allow-Methods: PUT");
header('Content-Type: application/json'); 

echo json_encode($result);
//parse_str(file_get_contents('php://input'), $data);

}
?>
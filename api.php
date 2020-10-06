<?php
include_once 'includes/courses.class.php';
include 'includes/connect.php';
$course = new Courses();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET': // Read
        $result = $course->getCourses();
        break;

    case 'POST': // Create
        $result = $course->addCourse($_POST['code'], $_POST['name'], $_POST['progression'], $_POST['syllabus']);
        break;

    case 'PUT': // Update
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $course->editOne($data['index'], $data['what'], $data['newvalue']);
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Accept, Content-Type");
        header("Access-Control-Allow-Methods: PUT");
        break;
        
    case 'DELETE': // Delete
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $course->deleteCourse($data['code']);
        header("Access-Control-Allow-Methods: DELETE");
        break;

    case 'OPTIONS': {
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Accept, Content-Type");
        header("Access-Control-Allow-Methods: PUT, DELETE");
        http_response_code(204);
        break;
    }
    
    default:
        die;
        break;
}

header("Access-Control-Allow-Origin: *");
//header('Content-Type: application/json'); 


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($result);
} else {
    //if (isset($result)) {
        echo $result;
    //}
}



?>
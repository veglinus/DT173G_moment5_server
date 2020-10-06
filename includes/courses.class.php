<?php

/*
db for connection
code for course code
name for name of course
progression either A or B
syllabus is URL to course syllabus

__construct creates connection to DB

setters for all variables

getCourses gets all courses
addCourse adds a new course with 4 inputs
deleteCourse deletes course where code = input
editOne edits one column, inputs: index(code of row), what rowname is being changed, newvalue is the new value

getters for all variables
*/


class Courses {

    private $db;
    private $code;
    private $name;
    private $progression;
    private $syllabus;

    function __construct() {
        $this->db = $mysqli = new mysqli(DBserver, DBuser, DBpw, DBdb);
        if ($this->db->connect_error) {
            exit('Error connecting to database: ' . $this->db->connect_error);
        }
    }

    public function setCode($value) {
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        $this->code = $value;
    }
    public function setName($value) {
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        $this->name = $value;
    }
    public function setProgression($value) {
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        $value = strtoupper($value);
        
        if ($value === 'A' || $value === 'B') { // Value is either A or B
            $this->progression = $value; // Otherwise let the value be
        } else {
            $this->progression = 'A'; // If value is not A or B; set it to A
        }
    }
    public function setSyllabus($value) {
        $value = filter_var($value, FILTER_SANITIZE_URL);
        $this->syllabus = $value;
    }

    function getCourses() {
        $stmt = $this->db->prepare("SELECT * FROM courses");
        if ($stmt->execute()) {
            $response = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (!$response) return false;
            return $response;
        } else {
            return $stmt->error;
        }
        $stmt->close();
    }

    
    function addCourse($code, $name, $progression, $syllabus) {
        // Setters to sanitize strings before inserting into DB
        // in case of SQL injection etc
        $this->setCode($code);
        $this->setName($name);
        $this->setProgression($progression);
        $this->setSyllabus($syllabus);
        
        $stmt = $this->db->prepare("INSERT INTO courses (code, name, progression, syllabus) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $this->getCode(), $this->getName(), $this->getProgression(), $this->getSyllabus());
        if ($stmt->execute()) {
            return 'Kurs tillagd!';
        } else {
            return $stmt->error;
        }
        $stmt->close();

    }

    function deleteCourse($code) {
        $this->setCode($code);

        $stmt = $this->db->prepare("DELETE FROM courses WHERE code LIKE ?");
        $stmt->bind_param("s", $this->getCode());

        if ($stmt->execute()) {
            return 'Kurs borttagen!';
        } else {
            return $stmt->error;
        }
        $stmt->close();
    }

    /*
    // Unused function to edit entire row
    function editCourse($index, $code, $name, $progression, $syllabus) {
        $index = filter_var($index, FILTER_SANITIZE_STRING); // index är vart vi ska redigera

        $this->setCode($code);
        $this->setName($name);
        $this->setProgression($progression);
        $this->setSyllabus($syllabus);
        
        $stmt = $this->db->prepare("UPDATE courses SET code = ?, name = ?, progression = ?, syllabus = ? WHERE code = ?");
        $stmt->bind_param("sssss", $this->getCode(), $this->getName(), $this->getProgression(), $this->getSyllabus(), $index);
        if ($stmt->execute()) {
            return 'Kurs ändrad!';
        } else {
            return $stmt->error;
        }
        $stmt->close();
    }*/

    function editOne($index, $what, $newvalue) {
        switch ($what) { // vad ska vi ändra på
            case 'kurskod':
                $stmt = $this->db->prepare("UPDATE courses SET code = ? WHERE code = ?");
                break;

            case 'kursnamn':
                $stmt = $this->db->prepare("UPDATE courses SET name = ? WHERE code = ?");
                break;

            case 'progression':
                $stmt = $this->db->prepare("UPDATE courses SET progression = ? WHERE code = ?");
                break;

            case 'syllabus':
                $stmt = $this->db->prepare("UPDATE courses SET syllabus = ? WHERE code = ?");
                break;
            
            default:
                break;
        }

        $index = filter_var($index, FILTER_SANITIZE_STRING); // index är vart vi ska redigera
        $newvalue = filter_var($newvalue, FILTER_SANITIZE_STRING); // index är vart vi ska redigera
        
        $stmt->bind_param("ss", $newvalue, $index);
        if ($stmt->execute()) {
            return 'Kurs ändrad!';
        } else {
            return $stmt->error;
        }
        $stmt->close();
    }


    public function getCode() {
        return $this->code;
    }
    public function getName() {
        return $this->name;
    }
    public function getProgression() {
        return $this->progression;
    }
    public function getSyllabus() {
        return $this->syllabus;
    }
}

?>
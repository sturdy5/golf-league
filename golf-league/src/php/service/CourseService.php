<?php 
include_once 'requires.inc.php';

if (isset($_GET["operation"])) {
    // the operation will map to one of the following values:
    //   - get 
    $operation = $_GET["operation"];
    switch ($operation){
        case "saveSide":
            // get the courseId and the sideName
            if (array_key_exists("courseId", $_GET) && array_key_exists("sideName", $_GET)) {
                $courseId = $_GET["courseId"];
                $sideName = $_GET["sideName"];
                $dao = new CourseDAO();
                $dao->saveCourseSide($sideName, $courseId);
                // TODO - save
                echo json_encode("success");
            } else {
                echo json_encode("Provide the course ID and the side name to save the side");
            }
            break;
        case "add":
            // get the courseName from the request
            if (array_key_exists("courseName", $_GET)) {
                $courseName = $_GET["courseName"];
                $dao = new CourseDAO();
                $courseId = $dao->saveCourse($courseName);
                echo json_encode($courseId);
            } else {
                echo json_encode("Provide the name of the course to create");
            }
            break;
        default:
            echo "Unsupported operation - " . $operation;
            break;
    }
}
?>

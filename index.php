<?php

switch ($_GET["act"]) {
    case "faculty":
        require_once('controllers/facultyController.php');
        $action = new Controllers\FacultyController();
        $action->getFaculty();
        break;
    
}
switch ($_POST['act']) {
    case "faculty":
        require_once('controllers/facultyController.php');
        $action = new Controllers\FacultyController();
        switch ($_POST['method']) {
            case "insertFaculty":
                $action->insertFaculty();
                break;
            case "updateFaculty":
                $action->updateFaculty();
                break;
            case "deleteFaculty":
                $action->deleteFaculty();
                break;
        }
        break;
}

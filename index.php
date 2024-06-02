<?php

switch($_GET["act"]) {
    case "faculty":
        require_once('controllers/facultyController.php');
        $action = new FacultyController();
        $action->startMethod($_GET['method']);
        break;
    // case "department":
    //     require_once('controllers/departmentController.php');
    // case "group":
    //     require_once('controllers/groupController.php');
    // case "student":
    //     require_once('controllers/studentController.php');
    
}
switch($_POST['act']) {
    case "faculty":
        require_once('controllers/facultyController.php');
        $action = new FacultyController();
        $action->startMethod($_POST['method']);
        break;
    // case "department":
    //     require_once('controllers/departmentController.php');
    // case "group":
    //     require_once('controllers/groupController.php');
    // case "student":
    //     require_once('controllers/studentController.php');
    }





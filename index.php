<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $connection = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
    mysqli_set_charset($connection, 'utf8mb4');
    printf("Успешно... %s\n", mysqli_get_host_info($connection));
    if ($_GET["action"] == "getfaculty"){
        include 'faculty/getfaculty.php';
        getfaculty();
    }
    if ($_GET["action"] == "getdepartment"){
        include 'department/getdepartment.php';
        getdepartment();
    }
    if ($_GET["action"] == "getgroup"){
        include 'group/getgroup.php';
        getgroup();
    }
    if ($_GET["action"] == "getstudent"){
        include 'student/getstudent.php';
        getstudent();
    }
    if ($_GET["action"] == "insertfaculty") {
        include 'faculty/insertfaculty.php';
        insertfaculty();
    }
    if ($_GET["action"] == "insertdepartment") {
    include 'department/insertdepartment.php';
    insertdepartment();
}
    if ($_GET["action"] == "insertgroup") {
    include 'group/insertgroup.php';
    insertgroup();
}
    if ($_GET["action"] == "insertstudent") {
    include 'student/insertstudent.php';
    insertstudent();
}
    if ($_GET["action"] == "deletefaculty") {
        include 'faculty/deletefaculty.php';
        deletefaculty();
    }
    if ($_GET["action"] == "deletedepartment") {
        include 'department/deletedepartment.php';
        deletedepartment();
    }
    if ($_GET["action"] == "deletegroup") {
        include 'group/deletegroup.php';
        deletegroup();
    }
    if ($_GET["action"] == "deletestudent") {
        include 'student/deletestudent.php';
        deletestudent();
    }
    if ($_GET["action"] == "updatefaculty") {
        include 'faculty/updatefaculty.php';
        updatefaculty();
    }
    if ($_GET["action"] == "updatedepartment") {
        include 'department/updatedepartment.php';
        updatedepartment();
    }
    if ($_GET["action"] == "updategroup") {
        include 'group/updategroup.php';
        updategroup();
    }
    if ($_GET["action"] == "updatestudent") {
        include 'student/updatestudent.php';
        updatestudent();
    }

    if($_GET["action"] == "gettree"){
        include 'faculty/getfaculty.php';
        getfaculty();
        include 'department/getdepartment.php';
        getdepartment();
        include 'group/getgroup.php';
        getgroup();
        include 'student/getstudent.php';
        getstudent();
    }









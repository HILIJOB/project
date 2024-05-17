<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"]))) {
        die("Incorrect input");
    }
    $params = [
        'facultyName' => $_POST['facultyName'],
        'id' => $_POST['id']
    ];
    $updatefacultysql = file_get_contents(dirname(__DIR__) . '/sql/sqlfaculty/updatefaculty.sql');
    $updatefacultyquery = $conn->prepare($updatefacultysql);
    $updatefacultyquery->execute($params);

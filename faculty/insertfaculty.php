<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    $params = [
        'facultyName' => $_POST['facultyName']
    ];
    $insertfacultysql = file_get_contents(dirname(__DIR__) . '/sql/sqlfaculty/insertfaculty.sql');
    $insertfacultyquery = $conn->prepare($insertfacultysql);
    $insertfacultyquery->execute($params);

<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    $getfacultysql = file_get_contents(dirname(__DIR__) . '/sql/faculty/getfaculty.sql');
    $getfacultyquery = $conn->prepare($getfacultysql);
    $getfacultyquery->execute();
    $faculties = $getfacultyquery->fetchAll(PDO::FETCH_ASSOC);
    $json = [];
    foreach($faculties as $faculty){
        $json[] = $faculty;
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

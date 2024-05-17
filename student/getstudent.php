<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    $getstudentsql = file_get_contents(dirname(__DIR__) . '/sql/student/getstudent.sql');
    $getsudentquery = $conn->prepare($getstudentsql);
    $getsudentquery->execute();
    $students = $getsudentquery->fetchAll(PDO::FETCH_ASSOC);
    $json = [];
    foreach($students as $student){
        $json[] = $student;
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

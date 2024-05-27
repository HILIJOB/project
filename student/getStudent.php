<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    $getStudentSql = file_get_contents(dirname(__DIR__) . '/sql/student/getStudent.sql');
    $getStudentQuery = $conn->prepare($getStudentSql);
    $getStudentQuery->execute();
    $students = $getStudentQuery->fetchAll(PDO::FETCH_ASSOC);
    $json = [];
    foreach ($students as $student) {
        $json[] = $student;
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

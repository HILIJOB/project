<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    $getFacultySql = file_get_contents(dirname(__DIR__) . '/sql/faculty/getFaculty.sql');
    $getFacultyQuery = $conn->prepare($getFacultySql);
    $getFacultyQuery->execute();
    $faculties = $getFacultyQuery->fetchAll(PDO::FETCH_ASSOC);
    $json = [];
    foreach ($faculties as $faculty) {
        $json[] = $faculty;
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

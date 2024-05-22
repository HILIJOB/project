<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php' );
    $getDepartmentSql = file_get_contents(dirname(__DIR__) . '/sql/department/getDepartment.sql');
    $getDepartmentQuery = $conn->prepare($getDepartmentSql);
    $getDepartmentQuery->execute();
    $departments = $getDepartmentQuery->fetchAll(PDO::FETCH_ASSOC);
    $json = [];
    foreach ($departments as $department) {
        $json[] = $department;
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
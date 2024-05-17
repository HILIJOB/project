<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php' );
    $getdepartmentsql = file_get_contents(dirname(__DIR__) . '/sql/department/getdepartment.sql');
    $getdepartmentquery = $conn->prepare($getdepartmentsql);
    $getdepartmentquery->execute();
    $departments = $getdepartmentquery->fetchAll(PDO::FETCH_ASSOC);
    $json = [];
    foreach($departments as $department){
        $json[] = $department;
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

<?php
    global $conn;
    require_once(__DIR__ . '/../connection.php');
    $params = [
        'departmentName' => $_POST['departmentName'],
        'facultyId' => $_POST['facultyId']
    ];
    $sql = file_get_contents(__DIR__ . '/../sql/insertdepartment.sql');
    $sth = $conn->prepare($sql);
    $sth->execute($params);

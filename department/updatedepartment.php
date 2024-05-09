<?php
    global $conn;
    require_once(__DIR__ . '/../connection.php');
    $params = [
        'departmentName' => $_POST['departmentName'],
        'id' => $_POST['id'],
        'facultyId' => $_POST['facultyId']
    ];
    $sql = file_get_contents(__DIR__ . '/../sql/updatedepartment.sql');
    $sth = $conn->prepare($sql);
    $sth->execute($params);

<?php
    global $conn;
    require_once(__DIR__ . '/../connection.php');
    $params = [
        'groupName' => $_POST['groupName'],
        'departmentId' => $_POST['departmentId']
    ];
    $sql = file_get_contents(__DIR__ . '/../sql/insertgroup.sql');
    $sth = $conn->prepare($sql);
    $sth->execute($params);

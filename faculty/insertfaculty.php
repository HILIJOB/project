<?php
    global $conn;
    require_once(__DIR__ . '/../connection.php');
    $params = [
        'facultyName' => $_POST['facultyName']
    ];
    $sql = file_get_contents(__DIR__ . '/../sql/insertfaculty.sql');
    $sth = $conn->prepare($sql);
    $sth->execute($params);

<?php
    global $conn;
    require_once(__DIR__ . '/../connection.php');
    $params = [
        'facultyName' => $_POST['facultyName'],
        'id' => $_POST['id']
    ];
    $sql = file_get_contents(__DIR__ . '/../sql/updatefaculty.sql');
    $sth = $conn->prepare($sql);
    $sth->execute($params);

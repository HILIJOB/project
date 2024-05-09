<?php
    global $conn;
    require_once(__DIR__ . '/../connection.php');
    $params = [
        'id' => $_POST['id']
    ];
    $sql = file_get_contents(__DIR__ . '/../sql/deletestudent.sql');
    $sth = $conn->prepare($sql);
    $sth->execute($params);

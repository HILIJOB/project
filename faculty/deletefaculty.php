<?php
    echo "123";
    global $conn;
    require_once(__DIR__ . '/../connection.php');
    $params = [
        'id' => $_POST['id']
    ];
    $sql = file_get_contents(__DIR__ . '/../sql/deletefaculty.sql');
    $sth = $conn->prepare($sql);
    $sth->execute($params);


<?php
    global $conn;
    require_once(__DIR__ . '/../connection.php');
    $sql = file_get_contents(__DIR__ . '/../sql/getdepartment.sql');
    $sth = $conn->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    $json = [];
    foreach($result as $row){
        $json[] = $row;
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

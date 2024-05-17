<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php' );
    $sql = file_get_contents(__DIR__ . '/../sql/getdepartment.sql');
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $json = [];
    foreach($result as $line){
        $json[] = $line;
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

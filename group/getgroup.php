<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    $getgroupsql = file_get_contents(dirname(__DIR__) .'/sql/group/getgroup.sql');
    $getgroupquery = $conn->prepare($getgroupsql);
    $getgroupquery->execute();
    $groups = $getgroupquery->fetchAll(PDO::FETCH_ASSOC);
    $json = [];
    foreach($groups as $group){
        $json[] = $group;
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

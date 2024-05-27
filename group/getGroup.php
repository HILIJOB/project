<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    $getGroupSql = file_get_contents(dirname(__DIR__) . '/sql/group/getGroup.sql');
    $getGroupQuery = $conn->prepare($getGroupSql);
    $getGroupQuery->execute();
    $groups = $getGroupQuery->fetchAll(PDO::FETCH_ASSOC);
    $json = [];
    foreach ($groups as $group) {
        $json[] = $group;
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

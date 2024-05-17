<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"]))) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $checkgroupsql = file_get_contents(dirname(__DIR__) . '/sql/group/checkgroup.sql');
    $checkgroupquery = $conn->prepare($checkgroupsql);
    $checkgroupquery ->execute($params);
    $checkgroup = $checkgroupquery->fetchAll(PDO::FETCH_ASSOC);
    if($checkgroup == array()){
        die("Не существующий id");
    }
    $deletegroupsql = file_get_contents(dirname(__DIR__) . '/sql/group/delete/deletegroup.sql');
    $deletestudentsql = file_get_contents(dirname(__DIR__) . '/sql/group/delete/deletestudentfromgr.sql');
    $conn->beginTransaction();
    try{
        $deletestudentquery = $conn->prepare($deletestudentsql);
        $deletestudentquery->execute($params);
        $deletegroupquery = $conn->prepare($deletegroupsql);
        $deletegroupquery->execute($params);
        $conn->commit();
    } catch(Exception $e){
        $conn->rollBack();
        echo $e -> getMessage();
    }


<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"]))) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $getgroupbyidsql = file_get_contents(dirname(__DIR__) . '/sql/group/getGroupById.sql');
    $getgroupbyidquery = $conn->prepare($getgroupbyidsql);
    $getgroupbyidquery->execute($params);
    $getgroupbyid = $getgroupbyidquery->fetchAll(PDO::FETCH_ASSOC);
    if(empty($getgroupbyid)){
        die("Не существующий id");
    }
    $deletegroupsql = file_get_contents(dirname(__DIR__) . '/sql/group/delete/deleteGroup.sql');
    $deletestudentsql = file_get_contents(dirname(__DIR__) . '/sql/group/delete/deleteStudentFromGroup.sql');
    $conn->beginTransaction();
    try{
        $deletestudentquery = $conn->prepare($deletestudentsql);
        $deletestudentquery->execute($params);
        $deletegroupquery = $conn->prepare($deletegroupsql);
        $deletegroupquery->execute($params);
        $conn->commit();
    } catch(Exception $e){
        $conn->rollBack();
        echo $e->getMessage();
    }


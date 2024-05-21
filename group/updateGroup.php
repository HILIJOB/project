<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"])) || !(ctype_digit($_POST["departmentId"])) || !preg_match("/^[а-я А-Я0-9-]+$/u",$_POST['groupName'])) {
        die("Неверный ввод");
    }
    $params = [
        'groupName' => $_POST['groupName'],
        'id' => $_POST['id'],
        'departmentId' => $_POST['departmentId']
    ];
    $getgroupbyidsql = file_get_contents(dirname(__DIR__) . '/sql/group/getGroupById.sql');
    $getgroupbyidquery = $conn->prepare($getgroupbyidsql);
    $getgroupbyidquery->bindParam('id',$_POST['id']);
    $getgroupbyidquery->execute();
    $getgroupbyid = $getgroupbyidquery->fetchAll(PDO::FETCH_ASSOC);
    if(empty($getgroupbyid)){
        die("Не существующий id");
    }
    $getdepartmentfromidsql = file_get_contents(dirname(__DIR__) . '/sql/department/getDepartmentById.sql');
    $getdepartmentfromidquery = $conn->prepare($getdepartmentfromidsql);
    $getdepartmentfromidquery->bindParam('id',$_POST['departmentId']);
    $getdepartmentfromidquery->execute();
    $getdepartmentfromid = $getdepartmentfromidquery->fetchAll(PDO::FETCH_ASSOC);
    if(empty($getdepartmentfromid)){
        die("Не существующий id кафедры");
    }
    $updategroupsql = file_get_contents(dirname(__DIR__) . '/sql/group/updateGroup.sql');
    $updategroupquery = $conn->prepare($updategroupsql);
    $updategroupquery->execute($params);

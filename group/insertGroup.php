<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["departmentId"])) || !preg_match("/^[а-я А-Я0-9-]+$/u",$_POST['groupName'])) {
        die("Неверный ввод");
    }
    $params = [
        'groupName' => $_POST['groupName'],
        'departmentId' => $_POST['departmentId']
    ];
    $getdepartmentbyidsql = file_get_contents(dirname(__DIR__) . '/sql/department/getDepartmentById.sql');
    $getdepartmentbyidquery = $conn->prepare($getdepartmentbyidsql);
    $getdepartmentbyidquery->bindParam('id',$_POST['departmentId']);
    $getdepartmentbyidquery->execute();
    $getdepartmentbyid = $getdepartmentbyidquery->fetchAll(PDO::FETCH_ASSOC);
    if(empty($getdepartmentbyid)){
        die("Не существующий id кафедры");
    }
    $insertgroupsql = file_get_contents(dirname(__DIR__) . '/sql/group/insertGroup.sql');
    $insertgroupquery = $conn->prepare($insertgroupsql);
    $insertgroupquery->execute($params);

<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"])) or !(ctype_digit($_POST["departmentId"])) or !preg_match("/^[а-я А-Я0-9-]+$/u",$_POST['groupName'])) {
        die("Неверный ввод");
    }
    $params = [
        'groupName' => $_POST['groupName'],
        'id' => $_POST['id'],
        'departmentId' => $_POST['departmentId']
    ];
    $checkgroupsql = file_get_contents(dirname(__DIR__) . '/sql/group/checkgroup.sql');
    $checkgroupquery = $conn->prepare($checkgroupsql);
    $checkgroupquery->bindParam('id',$_POST['id']);
    $checkgroupquery ->execute();
    $checkgroup = $checkgroupquery->fetchAll(PDO::FETCH_ASSOC);
    if($checkgroup == array()){
        die("Не существующий id");
    }
    $checkdepartmentsql = file_get_contents(dirname(__DIR__) . '/sql/department/checkdepartment.sql');
    $checkdepartmentquery = $conn->prepare($checkdepartmentsql);
    $checkdepartmentquery->bindParam('id',$_POST['departmentId']);
    $checkdepartmentquery ->execute();
    $checkdepartment = $checkdepartmentquery->fetchAll(PDO::FETCH_ASSOC);
    if($checkdepartment == array()){
        die("Не существующий id кафедры");
    }
    $updategroupsql = file_get_contents(dirname(__DIR__) .  '/sql/group/updategroup.sql');
    $updategroupquery = $conn->prepare($updategroupsql);
    $updategroupquery->execute($params);

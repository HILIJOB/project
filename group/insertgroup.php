<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["departmentId"])) or !preg_match("/^[а-я А-Я0-9-]+$/u",$_POST['groupName'])) {
        die("Неверный ввод");
    }
    $params = [
        'groupName' => $_POST['groupName'],
        'departmentId' => $_POST['departmentId']
    ];
    $checkdepartmentsql = file_get_contents(dirname(__DIR__) . '/sql/department/checkdepartment.sql');
    $checkdepartmentquery = $conn->prepare($checkdepartmentsql);
    $checkdepartmentquery->bindParam('id',$_POST['departmentId']);
    $checkdepartmentquery ->execute();
    $checkdepartment = $checkdepartmentquery->fetchAll(PDO::FETCH_ASSOC);
    if($checkdepartment == array()){
        die("Не существующий id кафедры");
    }
    $insertgroupsql = file_get_contents(dirname(__DIR__) .  '/sql/group/insertgroup.sql');
    $insertgroupquery = $conn->prepare($insertgroupsql);
    $insertgroupquery->execute($params);

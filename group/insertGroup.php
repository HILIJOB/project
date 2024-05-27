<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if (!(ctype_digit($_POST["departmentId"])) || !preg_match("/^[а-я А-Я0-9-]+$/u",$_POST['groupName'])) {
        die("Неверный ввод");
    }
    $params = [
        'groupName' => $_POST['groupName'],
        'departmentId' => $_POST['departmentId']
    ];
    $getDepartmentByIdSql = file_get_contents(dirname(__DIR__) . '/sql/department/getDepartmentById.sql');
    $getDepartmentByIdQuery = $conn->prepare($getDepartmentByIdSql);
    $getDepartmentByIdQuery->bindParam('id',$_POST['departmentId']);
    $getDepartmentByIdQuery->execute();
    $getDepartmentById = $getDepartmentByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getDepartmentById)) {
        die("Не существующий id кафедры");
    }
    $insertGroupSql = file_get_contents(dirname(__DIR__) . '/sql/group/insertGroup.sql');
    $insertGroupQuery = $conn->prepare($insertGroupSql);
    $insertGroupQuery->execute($params);

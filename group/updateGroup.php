<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if (!(ctype_digit($_POST["id"])) || !(ctype_digit($_POST["departmentId"])) || !preg_match("/^[а-я А-Я0-9-]+$/u",$_POST['groupName'])) {
        die("Неверный ввод");
    }
    $params = [
        'groupName' => $_POST['groupName'],
        'id' => $_POST['id'],
        'departmentId' => $_POST['departmentId']
    ];
    $getGroupByIdSql = file_get_contents(dirname(__DIR__) . '/sql/group/getGroupById.sql');
    $getGroupByIdQuery = $conn->prepare($getGroupByIdSql);
    $getGroupByIdQuery->bindParam('id',$_POST['id']);
    $getGroupByIdQuery->execute();
    $getGroupById = $getGroupByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getGroupById)) {
        die("Не существующий id");
    }
    $getDepartmentByIdSql = file_get_contents(dirname(__DIR__) . '/sql/department/getDepartmentById.sql');
    $getDepartmentByIdQuery = $conn->prepare($getDepartmentByIdSql);
    $getDepartmentByIdQuery->bindParam('id',$_POST['departmentId']);
    $getDepartmentByIdQuery->execute();
    $getDepartmentById = $getDepartmentByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getDepartmentById)) {
        die("Не существующий id кафедры");
    }
    $updateGroupSql = file_get_contents(dirname(__DIR__) . '/sql/group/updateGroup.sql');
    $updateGroupQuery = $conn->prepare($updateGroupSql);
    $updateGroupQuery->execute($params);

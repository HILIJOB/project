<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if (!(ctype_digit($_POST["id"]))) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $getDepartmentByIdSql = file_get_contents(dirname(__DIR__) . '/sql/department/getDepartmentById.sql');
    $getDepartmentByIdQuery = $conn->prepare($getDepartmentByIdSql);
    $getDepartmentByIdQuery->execute($params);
    $getDepartmentById = $getDepartmentByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getDepartmentById)) {
        die("Не существующий id");
    }
    $deleteDepartmentSql = file_get_contents(dirname(__DIR__) . '/sql/department/delete/deleteDepartment.sql');
    $deleteGroupSql = file_get_contents(dirname(__DIR__) . '/sql/department/delete/deleteGroupFromDepartment.sql');
    $deleteStudentSql = file_get_contents(dirname(__DIR__) . '/sql/department/delete/deleteStudentFromDepartment.sql');
    $conn->beginTransaction();
    try {
        $deleteStudentQuery = $conn->prepare($deleteStudentSql);
        $deleteStudentQuery->execute($params);
        $deleteGroupQuery = $conn->prepare($deleteGroupSql);
        $deleteGroupQuery->execute($params);
        $deleteDepartmentQuery = $conn->prepare($deleteDepartmentSql);
        $deleteDepartmentQuery->execute($params);
        $conn->commit();
    } catch(Exception $e) {
        $conn->rollBack();
        echo $e->getMessage();
    }


<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if (!(ctype_digit($_POST["id"]))) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $getGroupByIdSql = file_get_contents(dirname(__DIR__) . '/sql/group/getGroupById.sql');
    $getGroupByIdQuery = $conn->prepare($getGroupByIdSql);
    $getGroupByIdQuery->execute($params);
    $getGroupById = $getGroupByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getGroupById)) {
        die("Не существующий id");
    }
    $deleteGroupSql = file_get_contents(dirname(__DIR__) . '/sql/group/delete/deleteGroup.sql');
    $deleteStudentSql = file_get_contents(dirname(__DIR__) . '/sql/group/delete/deleteStudentFromGroup.sql');
    $conn->beginTransaction();
    try {
        $deleteStudentQuery = $conn->prepare($deleteStudentSql);
        $deleteStudentQuery->execute($params);
        $deleteGroupQuery = $conn->prepare($deleteGroupSql);
        $deleteGroupQuery->execute($params);
        $conn->commit();
    } catch(Exception $e) {
        $conn->rollBack();
        echo $e->getMessage();
    }


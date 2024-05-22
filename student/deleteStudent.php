<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if (!(ctype_digit($_POST["id"]))) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $getStudentByIdSql = file_get_contents(dirname(__DIR__) . '/sql/student/getStudentById.sql');
    $getStudentByIdQuery = $conn->prepare($getStudentByIdSql);
    $getStudentByIdQuery->execute($params);
    $getStudentById = $getStudentByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getStudentById)) {
        die("Не существующий id");
    }
    $deleteGroupSql = file_get_contents(dirname(__DIR__) . '/sql/student/deleteStudent.sql');
    $conn->beginTransaction();
    try {
        $deleteGroupQuery = $conn->prepare($deleteGroupSql);
        $deleteGroupQuery->execute($params);
        $conn->commit();
    } catch(Exception $e) {
        $conn->rollBack();
        echo $e->getMessage();
    }


<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if (!(ctype_digit($_POST["id"]))) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $getFacultyByIdSql = file_get_contents(dirname(__DIR__) . '/sql/faculty/getFacultyById.sql');
    $getFacultyByIdQuery = $conn->prepare($getFacultyByIdSql);
    $getFacultyByIdQuery->execute($params);
    $getFacultyById = $getFacultyByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getFacultyById)) {
        die("Не существующий id");
    }
    $deleteFacultySql = file_get_contents(dirname(__DIR__) . '/sql/faculty/delete/deleteFaculty.sql');
    $deleteDepartmentSql = file_get_contents(dirname(__DIR__) . '/sql/faculty/delete/deleteDepartmentFromFaculty.sql');
    $deleteGroupSql = file_get_contents(dirname(__DIR__) . '/sql/faculty/delete/deleteGroupFromFac.sql');
    $deleteStudentSql = file_get_contents(dirname(__DIR__) . '/sql/faculty/delete/deleteStudentFromFac.sql');
    $conn->beginTransaction();
    try {
        $deleteStudentQuery = $conn->prepare($deleteStudentSql);
        $deleteStudentQuery->execute($params);
        $deleteGroupQuery = $conn->prepare($deleteGroupSql);
        $deleteGroupQuery->execute($params);
        $deleteDepartmentQuery = $conn->prepare($deleteDepartmentSql);
        $deleteDepartmentQuery->execute($params);
        $deleteFacultyQuery = $conn->prepare($deleteFacultySql);
        $deleteFacultyQuery->execute($params);
        $conn->commit();
    } catch(Exception $e) {
        $conn->rollBack();
        echo $e->getMessage();
    }


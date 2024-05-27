<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if (!(ctype_digit($_POST["id"]))||(!(ctype_digit($_POST["facultyId"])))||!preg_match("/^[а-я А-Я]+$/u",$_POST['departmentName'])) {
        die("Неверный ввод");
    }
    $params = [
        'departmentName' => $_POST['departmentName'],
        'id' => $_POST['id'],
        'facultyId' => $_POST['facultyId']
    ];
    $getFacultyByIdSql = file_get_contents(dirname(__DIR__) . '/sql/faculty/getFacultyById.sql');
    $getFacultyByIdQuery = $conn->prepare($getFacultyByIdSql);
    $getFacultyByIdQuery->bindParam('id',$_POST['facultyId']);
    $getFacultyByIdQuery->execute();
    $getFacultyById = $getFacultyByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getFacultyById)) {
        die("Не существующий id факультета");
    }
    $getDepartmentFromIdSql = file_get_contents(dirname(__DIR__) . '/sql/department/getDepartmentById.sql');
    $getDepartmentFromIdQuery = $conn->prepare($getDepartmentFromIdSql);
    $getDepartmentFromIdQuery->bindParam('id',$_POST['id']);
    $getDepartmentFromIdQuery->execute();
    $getDepartmentFromId = $getDepartmentFromIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getDepartmentFromId)) {
        die("Не существующий id");
    }
    $updateDepartmentSql = file_get_contents(dirname(__DIR__) . '/sql/department/updateDepartment.sql');
    $updateDepartmentQuery = $conn->prepare($updateDepartmentSql);
    $updateDepartmentQuery->execute($params);

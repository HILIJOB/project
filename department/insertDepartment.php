<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if (!(ctype_digit($_POST["facultyId"])) || !preg_match("/^[а-я А-Я]+$/u",$_POST['departmentName'])) {
        die("Неверный ввод");
    }
    $getFacultyByIdSql = file_get_contents(dirname(__DIR__) . '/sql/faculty/getFacultyById.sql');
    $getFacultyByIdQuery = $conn->prepare($getFacultyByIdSql);
    $getFacultyByIdQuery->bindParam('id',$_POST['facultyId']);
    $getFacultyByIdQuery->execute();
    $getFacultyById = $getFacultyByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getFacultyById)) {
        die("Не существующий id факультета");
    }
    $params = [
        'departmentName' => $_POST['departmentName'],
        'facultyId' => $_POST['facultyId']
    ];
    $insertDepartmentSql = file_get_contents(dirname(__DIR__) . '/sql/department/insertDepartment.sql');
    $insertDepartmentQuery = $conn->prepare($insertDepartmentSql);
    $insertDepartmentQuery->execute($params);

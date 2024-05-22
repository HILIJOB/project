<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if (!(ctype_digit($_POST["id"])) || !preg_match("/^[а-я А-Я]+$/u",$_POST['facultyName'])) {
        die("Неверный ввод");
    }
    $params = [
        'facultyName' => $_POST['facultyName'],
        'id' => $_POST['id']
    ];
    $getFacultyByIdSql = file_get_contents(dirname(__DIR__) . '/sql/faculty/getFacultyById.sql');
    $getFacultyByIdQuery = $conn->prepare($getFacultyByIdSql);
    $getFacultyByIdQuery->bindParam('id',$_POST['id']);
    $getFacultyByIdQuery->execute();
    $getFacultyById = $getFacultyByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getFacultyById)) {
        die("Не существующий id");
    }
    $updateFacultySql = file_get_contents(dirname(__DIR__) . '/sql/faculty/updateFaculty.sql');
    $updateFacultyQuery = $conn->prepare($updateFacultySql);
    $updateFacultyQuery->execute($params);

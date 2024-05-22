<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if (!(ctype_digit($_POST["id"])) || !(ctype_digit($_POST["groupId"])) || !preg_match("/^[а-я А-Я]+$/u",
        $_POST['studentFirstName'])
    || !preg_match("/^[а-я А-Я]+$/u",$_POST['studentLastName']) || !preg_match("/^[а-я А-Я]+$/u",$_POST['studentPatronimic'])
    || !preg_match("/^[ 0-9-]+$/u",$_POST['studentBirthday'])) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST['id'],
        'studentFirstName' => $_POST['studentFirstName'],
        'studentLastName' => $_POST['studentLastName'],
        'studentPatronimic' => $_POST['studentPatronimic'],
        'studentBirthday' => $_POST['studentBirthday'],
        'groupId' => $_POST['groupId']
    ];
    $getStudentByIdSql = file_get_contents(dirname(__DIR__) . '/sql/student/getStudentById.sql');
    $getStudentByIdQuery = $conn->prepare($getStudentByIdSql);
    $getStudentByIdQuery->bindParam('id',$_POST['id']);
    $getStudentByIdQuery->execute();
    $getStudentById = $getStudentByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getStudentById)) {
        die("Не существующий id");
    }
    $getGroupByIdSql = file_get_contents(dirname(__DIR__) . '/sql/group/getGroupById.sql');
    $getGroupByIdQuery = $conn->prepare($getGroupByIdSql);
    $getGroupByIdQuery->bindParam('id',$_POST['groupId']);
    $getGroupByIdQuery->execute();
    $getGroupById = $getGroupByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getGroupById)) {
        die("Не существующий id группы");
    }
    $updateStudentSql = file_get_contents(dirname(__DIR__) . '/sql/student/updateStudent.sql');
    $updateStudentQuery = $conn->prepare($updateStudentSql);
    $updateStudentQuery->execute($params);

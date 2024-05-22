<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if (!(ctype_digit($_POST["groupId"])) || !preg_match("/^[а-я А-Я]+$/u",$_POST['studentFirstName'])
       || !preg_match("/^[а-я А-Я]+$/u",$_POST['studentLastName']) || !preg_match("/^[а-я А-Я]+$/u",$_POST['studentPatronimic'])
       || !preg_match("/^[ 0-9-]+$/u",$_POST['studentBirthday'])) {
        die("Неверный ввод");
    }
    $params = [
        'studentFirstName' => $_POST['studentFirstName'],
        'studentLastName' => $_POST['studentLastName'],
        'studentPatronimic' => $_POST['studentPatronimic'],
        'studentBirthday' => $_POST['studentBirthday'],
        'groupId' => $_POST['groupId']
    ];
    $getGroupByIdSql = file_get_contents(dirname(__DIR__) . '/sql/group/getGroupById.sql');
    $getGroupByIdQuery = $conn->prepare($getGroupByIdSql);
    $getGroupByIdQuery->bindParam('id',$_POST['groupId']);
    $getGroupByIdQuery->execute();
    $getGroupById = $getGroupByIdQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($getGroupById)) {
        die("Не существующий id группы");
    }
    $insertStudentSql = file_get_contents(dirname(__DIR__) . '/sql/student/insertStudent.sql');
    $insertStudentQuery = $conn->prepare($insertStudentSql);
    $insertStudentQuery->execute($params);

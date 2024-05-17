<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["groupId"])) or !preg_match("/^[а-я А-Я]+$/u",$_POST['studentFirstName'])
        or !preg_match("/^[а-я А-Я]+$/u",$_POST['studentLastName']) or !preg_match("/^[а-я А-Я]+$/u",$_POST['studentPatronimic'])
        or !preg_match("/^[ 0-9-]+$/u",$_POST['studentBirthday'])) {
        die("Неверный ввод");
    }
    $params = [
        'studentFirstName' => $_POST['studentFirstName'],
        'studentLastName' => $_POST['studentLastName'],
        'studentPatronimic' => $_POST['studentPatronimic'],
        'studentBirthday' => $_POST['studentBirthday'],
        'groupId' => $_POST['groupId']
    ];
    $checkgroupsql = file_get_contents(dirname(__DIR__) . '/sql/group/checkgroup.sql');
    $checkgroupquery = $conn->prepare($checkgroupsql);
    $checkgroupquery->bindParam('id',$_POST['groupId']);
    $checkgroupquery ->execute();
    $checkgroup = $checkgroupquery->fetchAll(PDO::FETCH_ASSOC);
    if($checkgroup == array()){
        die("Не существующий id группы");
    }
    $insertstudentsql = file_get_contents(dirname(__DIR__) . '/sql/student/insertstudent.sql');
    $insertstudentquery = $conn->prepare($insertstudentsql);
    $insertstudentquery->execute($params);

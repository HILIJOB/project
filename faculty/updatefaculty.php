<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"])) or !preg_match("/^[а-я А-Я]+$/u",$_POST['facultyName'])) {
        die("Неверный ввод");
    }
    $params = [
        'facultyName' => $_POST['facultyName'],
        'id' => $_POST['id']
    ];
    $checkfacultysql = file_get_contents(dirname(__DIR__) . '/sql/faculty/checkfaculty.sql');
    $checkfacultyquery = $conn->prepare($checkfacultysql);
    $checkfacultyquery->bindParam('id',$_POST['id']);
    $checkfacultyquery ->execute();
    $checkfaculty = $checkfacultyquery->fetchAll(PDO::FETCH_ASSOC);
    if($checkfaculty == array()){
        die("Не существующий id");
    }
    $updatefacultysql = file_get_contents(dirname(__DIR__) . '/sql/faculty/updatefaculty.sql');
    $updatefacultyquery = $conn->prepare($updatefacultysql);
    $updatefacultyquery->execute($params);

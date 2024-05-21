<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"])) || !preg_match("/^[а-я А-Я]+$/u",$_POST['facultyName'])) {
        die("Неверный ввод");
    }
    $params = [
        'facultyName' => $_POST['facultyName'],
        'id' => $_POST['id']
    ];
    $getfacultybyidsql = file_get_contents(dirname(__DIR__) . '/sql/faculty/getFacultyById.sql');
    $getfacultybyidquery = $conn->prepare($getfacultybyidsql);
    $getfacultybyidquery->bindParam('id',$_POST['id']);
    $getfacultybyidquery->execute();
    $getfacultybyid = $getfacultybyidquery->fetchAll(PDO::FETCH_ASSOC);
    if(empty($getfacultybyid)){
        die("Не существующий id");
    }
    $updatefacultysql = file_get_contents(dirname(__DIR__) . '/sql/faculty/updateFaculty.sql');
    $updatefacultyquery = $conn->prepare($updatefacultysql);
    $updatefacultyquery->execute($params);

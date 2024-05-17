<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!preg_match("/^[а-я А-Я]+$/u",$_POST['facultyName']) ){
        die ("Неверный ввод");
    }
    $params = [
        'facultyName' => $_POST['facultyName']
    ];
    $insertfacultysql = file_get_contents(dirname(__DIR__) . '/sql/faculty/insertfaculty.sql');
    $insertfacultyquery = $conn->prepare($insertfacultysql);
    $insertfacultyquery->execute($params);

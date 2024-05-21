<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"]))) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $getstudentbyidsql = file_get_contents(dirname(__DIR__) . '/sql/student/getStudentById.sql');
    $getstudentbyidquery = $conn->prepare($getstudentbyidsql);
    $getstudentbyidquery->execute($params);
    $getstudentbyid = $getstudentbyidquery->fetchAll(PDO::FETCH_ASSOC);
    if(empty($getstudentbyid)){
        die("Не существующий id");
    }
    $deletegroupsql = file_get_contents(dirname(__DIR__) . '/sql/student/deleteStudent.sql');
    $conn->beginTransaction();
    try{
        $deletegroupquery = $conn->prepare($deletegroupsql);
        $deletegroupquery->execute($params);
        $conn->commit();
    } catch(Exception $e){
        $conn->rollBack();
        echo $e->getMessage();
    }


<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"]))) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $checkstudentsql = file_get_contents(dirname(__DIR__) . '/sql/student/checkstudent.sql');
    $checkstudentquery = $conn->prepare($checkstudentsql);
    $checkstudentquery ->execute($params);
    $checkstudent = $checkstudentquery->fetchAll(PDO::FETCH_ASSOC);
    if($checkstudent == array()){
        die("Не существующий id");
    }
    $deletegroupsql = file_get_contents(dirname(__DIR__) . '/sql/student/deletestudent.sql');
    $conn->beginTransaction();
    try{
        $deletegroupquery = $conn->prepare($deletegroupsql);
        $deletegroupquery->execute($params);
        $conn->commit();
    } catch(Exception $e){
        $conn->rollBack();
        echo $e -> getMessage();
    }


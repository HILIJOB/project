<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"]))) {
        die("Incorrect input");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $deletefacultysql = file_get_contents(dirname(__DIR__) . '/sql/sqlfaculty/deletefaculty/deletefaculty.sql');
    $deletedepartmentsql = file_get_contents(dirname(__DIR__) . '/sql/sqlfaculty/deletefaculty/deletedepartmentfromfac.sql');
    $deletegroupsql = file_get_contents(dirname(__DIR__) . '/sql/sqlfaculty/deletefaculty/deletegroupfromfac.sql');
    $deletestudentsql = file_get_contents(dirname(__DIR__) . '/sql/sqlfaculty/deletefaculty/deletestudentfromfac.sql');
    $conn->beginTransaction();
    try{
        $deletestudentquery = $conn->prepare($deletestudentsql);
        $deletestudentquery->execute($params);
        $deletegroupquery = $conn->prepare($deletegroupsql);
        $deletegroupquery->execute($params);
        $deletedepartmentquery=$conn->prepare($deletedepartmentsql);
        $deletedepartmentquery->execute($params);
        $deletefacultyquery = $conn->prepare($deletefacultysql);
        $deletefacultyquery->execute($params);
        $conn->commit();
    } catch(Exception $e){
        $conn->rollBack();
        echo $e -> getMessage();
    }


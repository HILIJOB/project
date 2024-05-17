<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"]))) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $checkfacultysql = file_get_contents(dirname(__DIR__) . '/sql/faculty/checkfaculty.sql');
    $checkfacultyquery = $conn->prepare($checkfacultysql);
    $checkfacultyquery ->execute($params);
    $checkfaculty = $checkfacultyquery->fetchAll(PDO::FETCH_ASSOC);
    if($checkfaculty == array()){
        die("Не существующий id");
    }
    $deletefacultysql = file_get_contents(dirname(__DIR__) . '/sql/faculty/delete/deletefaculty.sql');
    $deletedepartmentsql = file_get_contents(dirname(__DIR__) . '/sql/faculty/delete/deletedepartmentfromfac.sql');
    $deletegroupsql = file_get_contents(dirname(__DIR__) . '/sql/faculty/delete/deletegroupfromfac.sql');
    $deletestudentsql = file_get_contents(dirname(__DIR__) . '/sql/faculty/delete/deletestudentfromfac.sql');
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


<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"]))) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $getfacultybyidsql = file_get_contents(dirname(__DIR__) . '/sql/faculty/getFacultyById.sql');
    $getfacultybyidquery = $conn->prepare($getfacultybyidsql);
    $getfacultybyidquery->execute($params);
    $getfacultybyid = $getfacultybyidquery->fetchAll(PDO::FETCH_ASSOC);
    if(empty($getfacultybyid)){
        die("Не существующий id");
    }
    $deletefacultysql = file_get_contents(dirname(__DIR__) . '/sql/faculty/delete/deleteFaculty.sql');
    $deletedepartmentsql = file_get_contents(dirname(__DIR__) . '/sql/faculty/delete/deleteDepartmentFromFaculty.sql');
    $deletegroupsql = file_get_contents(dirname(__DIR__) . '/sql/faculty/delete/deleteGroupFromFac.sql');
    $deletestudentsql = file_get_contents(dirname(__DIR__) . '/sql/faculty/delete/deleteStudentFromFac.sql');
    $conn->beginTransaction();
    try{
        $deletestudentquery = $conn->prepare($deletestudentsql);
        $deletestudentquery->execute($params);
        $deletegroupquery = $conn->prepare($deletegroupsql);
        $deletegroupquery->execute($params);
        $deletedepartmentquery = $conn->prepare($deletedepartmentsql);
        $deletedepartmentquery->execute($params);
        $deletefacultyquery = $conn->prepare($deletefacultysql);
        $deletefacultyquery->execute($params);
        $conn->commit();
    } catch(Exception $e){
        $conn->rollBack();
        echo $e->getMessage();
    }


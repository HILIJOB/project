<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"]))) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $getdepartmentfromidsql = file_get_contents(dirname(__DIR__) . '/sql/department/getDepartmentById.sql');
    $getdepartmentfromidquery = $conn->prepare($getdepartmentfromidsql);
    $getdepartmentfromidquery->execute($params);
    $getdepartmentfromid = $getdepartmentfromidquery->fetchAll(PDO::FETCH_ASSOC);
    if(empty($getdepartmentfromid)){
        die("Не существующий id");
    }
    $deletedepartmentsql = file_get_contents(dirname(__DIR__) . '/sql/department/delete/deleteDepartment.sql');
    $deletegroupsql = file_get_contents(dirname(__DIR__) . '/sql/department/delete/deleteGroupFromDepartment.sql');
    $deletestudentsql = file_get_contents(dirname(__DIR__) . '/sql/department/delete/deleteStudentFromDepartment.sql');
    $conn->beginTransaction();
    try{
        $deletestudentquery = $conn->prepare($deletestudentsql);
        $deletestudentquery->execute($params);
        $deletegroupquery = $conn->prepare($deletegroupsql);
        $deletegroupquery->execute($params);
        $deletedepartmentquery = $conn->prepare($deletedepartmentsql);
        $deletedepartmentquery->execute($params);
        $conn->commit();
    } catch(Exception $e){
        $conn->rollBack();
        echo $e->getMessage();
    }


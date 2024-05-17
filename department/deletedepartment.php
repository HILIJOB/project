<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"]))) {
        die("Неверный ввод");
    }
    $params = [
        'id' => $_POST["id"]
    ];
    $checkdepartmentsql = file_get_contents(dirname(__DIR__) . '/sql/department/checkdepartment.sql');
    $checkdepartmentquery = $conn->prepare($checkdepartmentsql);
    $checkdepartmentquery ->execute($params);
    $checkdepartment = $checkdepartmentquery->fetchAll(PDO::FETCH_ASSOC);
    if($checkdepartment == array()){
        die("Не существующий id");
    }
    $deletedepartmentsql = file_get_contents(dirname(__DIR__) . '/sql/department/delete/deletedepartmentfromdep.sql');
    $deletegroupsql = file_get_contents(dirname(__DIR__) . '/sql/department/delete/deletegroupfromdep.sql');
    $deletestudentsql = file_get_contents(dirname(__DIR__) . '/sql/department/delete/deletestudentfromdep.sql');
    $conn->beginTransaction();
    try{
        $deletestudentquery = $conn->prepare($deletestudentsql);
        $deletestudentquery->execute($params);
        $deletegroupquery = $conn->prepare($deletegroupsql);
        $deletegroupquery->execute($params);
        $deletedepartmentquery=$conn->prepare($deletedepartmentsql);
        $deletedepartmentquery->execute($params);
        $conn->commit();
    } catch(Exception $e){
        $conn->rollBack();
        echo $e -> getMessage();
    }


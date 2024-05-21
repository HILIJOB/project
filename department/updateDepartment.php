<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"]))||(!(ctype_digit($_POST["facultyId"])))||!preg_match("/^[а-я А-Я]+$/u",$_POST['departmentName'])) {
        die("Неверный ввод");
    }
    $params = [
        'departmentName' => $_POST['departmentName'],
        'id' => $_POST['id'],
        'facultyId' => $_POST['facultyId']
    ];
    $getfacultyfromidsql = file_get_contents(dirname(__DIR__) . '/sql/faculty/getFacultyById.sql');
    $getfacultyfromidquery = $conn->prepare($getfacultyfromidsql);
    $getfacultyfromidquery->bindParam('id',$_POST['facultyId']);
    $getfacultyfromidquery->execute();
    $getfacultyfromid = $getfacultyfromidquery->fetchAll(PDO::FETCH_ASSOC);
    if(empty($getfacultyfromid)){
        die("Не существующий id факультета");
    }
    $getdepartmentfromidsql = file_get_contents(dirname(__DIR__) . '/sql/department/getDepartmentById.sql');
    $getdepartmentfromidquery = $conn->prepare($getdepartmentfromidsql);
    $getdepartmentfromidquery->bindParam('id',$_POST['id']);
    $getdepartmentfromidquery->execute();
    $getdepartmentfromid = $getdepartmentfromidquery->fetchAll(PDO::FETCH_ASSOC);
    if(empty($getdepartmentfromid)){
        die("Не существующий id");
    }
    $updatedepartmentsql = file_get_contents(dirname(__DIR__) . '/sql/department/updateDepartment.sql');
    $updatedepartmentquery = $conn->prepare($updatedepartmentsql);
    $updatedepartmentquery->execute($params);

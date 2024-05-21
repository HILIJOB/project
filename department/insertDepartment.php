<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["facultyId"])) || !preg_match("/^[а-я А-Я]+$/u",$_POST['departmentName'])) {
        die("Неверный ввод");
    }
    $getfacultyfromidsql = file_get_contents(dirname(__DIR__) . '/sql/faculty/getFacultyById.sql');
    $getfacultyfromidquery = $conn->prepare($getfacultyfromidsql);
    $getfacultyfromidquery->bindParam('id',$_POST['facultyId']);
    $getfacultyfromidquery->execute();
    $getfacultyfromid = $getfacultyfromidquery->fetchAll(PDO::FETCH_ASSOC);
    if(empty($getfacultyfromid)){
        die("Не существующий id факультета");
    }
    $params = [
        'departmentName' => $_POST['departmentName'],
        'facultyId' => $_POST['facultyId']
    ];
    $insertdepartmentsql = file_get_contents(dirname(__DIR__) . '/sql/department/insertDepartment.sql');
    $insertdepartmentquery = $conn->prepare($insertdepartmentsql);
    $insertdepartmentquery->execute($params);

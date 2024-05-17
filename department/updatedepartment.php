<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["id"])) or (!(ctype_digit($_POST["facultyId"]))) or !preg_match("/^[а-я А-Я]+$/u",$_POST['departmentName'])) {
        die("Неверный ввод");
    }
    $params = [
        'departmentName' => $_POST['departmentName'],
        'id' => $_POST['id'],
        'facultyId' => $_POST['facultyId']
    ];
    $checkfacultysql = file_get_contents(dirname(__DIR__) . '/sql/faculty/checkfaculty.sql');
    $checkfacultyquery = $conn->prepare($checkfacultysql);
    $checkfacultyquery->bindParam('id',$_POST['facultyId']);
    $checkfacultyquery ->execute();
    $checkfaculty = $checkfacultyquery->fetchAll(PDO::FETCH_ASSOC);
    if($checkfaculty == array()){
        die("Не существующий id факультета");
    }
    $checkdepartmentsql = file_get_contents(dirname(__DIR__) . '/sql/department/checkdepartment.sql');
    $checkdepartmentquery = $conn->prepare($checkdepartmentsql);
    $checkdepartmentquery->bindParam('id',$_POST['id']);
    $checkdepartmentquery ->execute();
    $checkdepartment = $checkdepartmentquery->fetchAll(PDO::FETCH_ASSOC);
    if($checkdepartment == array()){
        die("Не существующий id");
    }
    $updatedepartmentsql = file_get_contents(dirname(__DIR__) .  '/sql/department/updatedepartment.sql');
    $updatedepartmentquery = $conn->prepare($updatedepartmentsql);
    $updatedepartmentquery->execute($params);

<?php
    global $conn;
    require_once(dirname(__DIR__) . '/connection.php');
    if(!(ctype_digit($_POST["facultyId"])) or !preg_match("/^[а-я А-Я]+$/u",$_POST['departmentName'])) {
        die("Неверный ввод");
    }
    $checkfacultysql = file_get_contents(dirname(__DIR__) . '/sql/faculty/checkfaculty.sql');
    $checkfacultyquery = $conn->prepare($checkfacultysql);
    $checkfacultyquery->bindParam('id',$_POST['facultyId']);
    $checkfacultyquery ->execute();
    $checkfaculty = $checkfacultyquery->fetchAll(PDO::FETCH_ASSOC);
    if($checkfaculty == array()){
        die("Не существующий id факультета");
    }
    $params = [
        'departmentName' => $_POST['departmentName'],
        'facultyId' => $_POST['facultyId']
    ];
    $insertdepartmentsql = file_get_contents(dirname(__DIR__) .  '/sql/department/insertdepartment.sql');
    $insertdepartmentquery = $conn->prepare($insertdepartmentsql);
    $insertdepartmentquery->execute($params);

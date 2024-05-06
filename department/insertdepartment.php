<?php
function insertdepartment()
{
    $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
    printf("Успешно... %s\n", mysqli_get_host_info($conn));
    $depart = $_GET["department"];
    $codefac = $_GET["facultyid"];
    $query= "INSERT INTO Department(Department, FacultyID) VALUES('$depart',$codefac)";
    if (mysqli_query($conn,$query)){
        echo "Данные внесены в таблицу Кафедра";
    } else{
        echo "Ошибка";
    }
}
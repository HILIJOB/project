<?php
function insertgroup()
{
    $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
    printf("Успешно... %s\n", mysqli_get_host_info($conn));
    $group = $_GET["group"];
    $codedep = $_GET["departmentid"];
    $query= "INSERT INTO Group1(Group1, DepartmentID) VALUES('$group',$codedep)";
    if (mysqli_query($conn,$query)){
        echo "Данные внесены в таблицу Группа";
    } else{
        echo "Ошибка";
    }
}

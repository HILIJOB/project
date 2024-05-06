<?php
function deletedepartment(){
    $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
    $delid = $_GET["deldepartmentid"];
    $query = "Delete from university.Department where departmentid = $delid";
    if (mysqli_query($conn,$query)){
        echo "Данные удалены";
    } else{
        echo "Ошибка";
    }
}

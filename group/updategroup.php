<?php
function updategroup(){
    $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
    $newgroup1 = $_GET["newgroup1"];
    $updateid = $_GET["updateid"];
    $newdepartmentid = $_GET["newdepartmentid"];
    $query = "UPDATE Group1 SET group1 = '$newgroup1', departmentid = $newdepartmentid WHERE groupid = '$updateid' ";
    if (mysqli_query($conn, $query)) {
        echo "Изменения записаны";
    } else{
        echo "Ошибка";
    }
}

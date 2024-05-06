<?php
function deletegroup(){
    $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
    $delid = $_GET["delgroupid"];
    $query = "Delete from university.Group1 where groupid = $delid";
    if (mysqli_query($conn,$query)){
        echo "Данные удалены";
    } else{
        echo "Ошибка";
    }
}

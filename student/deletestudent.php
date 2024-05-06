<?php
function deletestudent(){
    $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
    $delid = $_GET["delstudentid"];
    $query = "Delete from university.Student where studentid = $delid";
    if (mysqli_query($conn,$query)){
        echo "Данные удалены";
    } else{
        echo "Ошибка";
    }
}

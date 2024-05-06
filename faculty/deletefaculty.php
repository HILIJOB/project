<?php
    function deletefaculty(){
        $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
        $delid = $_GET["delfacultyid"];
        $query = "Delete from university.Faculty where facultyid = $delid";
        if (mysqli_query($conn,$query)){
            echo "Данные удалены";
        } else{
            echo "Ошибка";
        }
    }

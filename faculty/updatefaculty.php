<?php
    function updatefaculty(){
        $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
        $newfaculty = $_GET['newfaculty'];
        $updateid = $_GET['updateid'];
        $query = "UPDATE Faculty SET faculty = '$newfaculty' WHERE facultyid = '$updateid'";
        if (mysqli_query($conn, $query)) {
            echo "Изменения записаны";
        } else{
            echo "Ошибка";
        }
    }

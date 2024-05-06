<?php
    function insertfaculty()
    {
        $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
        printf("Успешно... %s\n", mysqli_get_host_info($conn));
        $getfac = $_GET["faculty"];
        $query= "INSERT INTO Faculty(Faculty) VALUES('$getfac')";
        if (mysqli_query($conn,$query)){
            echo "Данные внесены в таблицу Факультет";
        } else{
            echo "Ошибка";
        }
    }

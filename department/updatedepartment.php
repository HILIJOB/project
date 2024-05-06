<?php
    function updatedepartment(){
        $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
        $newdepartment = $_GET["newdepartment"];
        $updateid = $_GET["updateid"];
        $newfacultyid = $_GET["newfacultyid"];
        $query = "UPDATE Department SET department = '$newdepartment', facultyid = '$newfacultyid' WHERE departmentid = '$updateid' ";
        if (mysqli_query($conn, $query)) {
            echo "Изменения записаны";
        } else{
            echo "Ошибка";
        }
    }

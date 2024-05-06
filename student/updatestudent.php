<?php
function updatestudent(){
    $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
    $updateid = $_GET["updateid"];
    $newfio = $_GET["newfio"];
    $newgroupid = $_GET["newgroupid"];
    $newdateob = $_GET["newdateob"];
    $query = "UPDATE Student SET fio = '$newfio', groupid = $newgroupid, dateob = '$newdateob' WHERE studentid = '$updateid' ";
    if (mysqli_query($conn, $query)) {
        echo "Изменения записаны";
    } else{
        echo "Ошибка";
    }
}

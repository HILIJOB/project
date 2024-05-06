<?php
function insertstudent()
{
    $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
    printf("Успешно... %s\n", mysqli_get_host_info($conn));
    $fioex = $_GET['fio'];
    $fio = str_replace('_', ' ', $fioex);
    $date = $_GET["dateob"];
    $codegr = $_GET["groupid"];
    $query = "INSERT INTO Student(FIO, DateOB, GroupID) VALUES('$fio','$date',$codegr)";
    if (mysqli_query($conn, $query)) {
        echo "Данные внесены в таблицу Студент";
    } else {
        echo "Ошибка";
    }
}

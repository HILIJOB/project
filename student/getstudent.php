<?php
function getstudent() {
    $query = "SELECT * FROM Student";
    $conn = mysqli_connect('127.0.0.1', 'dbuser', 'password', 'university');
    $rows = mysqli_query($conn,$query);
    $json = [];
    while($row = mysqli_fetch_assoc($rows)) {
        $json[] = $row;
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
}
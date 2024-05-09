<?php
    global $conn;
    require_once(__DIR__ . '/../connection.php');
    $params = [
        'studentFirstName' => $_POST['studentFirstName'],
        'id' => $_POST['id'],
        'studentLastName' => $_POST['studentLastName'],
        'studentPatronimic' => $_POST['studentPatronimic'],
        'studentBirthday' => $_POST['studentBirthday']
    ];
    $sql = file_get_contents(__DIR__ . '/../sql/updatestudent.sql');
    $sth = $conn->prepare($sql);
    $sth->execute($params);

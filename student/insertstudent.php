<?php
    global $conn;
    require_once(__DIR__ . '/../connection.php');
    $params = [
        'studentFirstName' => $_POST['studentFirstName'],
        'studentLastName' => $_POST['studentLastName'],
        'studentPatronimic' => $_POST['studentPatronimic'],
        'studentBirthday' => $_POST['studentBirthday'],
        'groupId' => $_POST['groupId']
    ];
    $sql = file_get_contents(__DIR__ . '/../sql/insertstudent.sql');
    $sth = $conn->prepare($sql);
    $sth->execute($params);

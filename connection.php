<?php
    try{
        $conn = new PDO('mysql:host=localhost;dbname=university', 'dbuser', 'password');
    } catch (PDOException $e) {
        echo "Ошибка подключения";
    }

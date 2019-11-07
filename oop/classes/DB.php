<?php

    session_start();

    $db_host = 'localhost';
    $db_name = 'oop_login_register';
    $db_user = 'stefan';
    $db_password = 'stefan12';

    try {
        $conn = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
    }

    include_once 'classes/User.php';
    $user = new User($conn);


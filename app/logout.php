<?php

    require __DIR__ . '/../vendor/autoload.php';

    use App\Classes\Connection;
    use App\Classes\User;

    session_start();

    $dbInstance = Connection::getInstance();
    $user_logout = new User($dbInstance);

    if ($user_logout->is_logged_in() != "") {
        $user_logout->redirect('index.php');
    }

    if (isset($_GET['logout']) && $_GET['logout'] == "true") {
        $user_logout->logout();
        $user_logout->redirect('login.php');
    }

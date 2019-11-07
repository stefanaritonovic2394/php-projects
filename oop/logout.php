<?php

    session_start();
    
    require_once('classes/User.php');

    $user_logout = new User($conn);

    if ($user_logout->is_logged_in() != "") {
        $user_logout->redirect('index.php');
    }

    if (isset($_GET['logout']) && $_GET['logout'] == "true") {
        $user_logout->logout();
        $user_logout->redirect('login.php');
    }

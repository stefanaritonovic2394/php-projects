<?php

interface LoginInterface 
{
    public function loginUser($user);
}

interface RegisterInterface 
{
    public function registerUser($user);
}

require 'classes/Login.php';
require 'classes/Register.php';

$login = new Login;
$register = new Register;
echo $login->loginUser('stefan') . '<br>';
echo $register->registerUser('marko');
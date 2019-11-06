<?php

interface LoginInterface 
{
    public function loginUser(string $user): string;
}

interface RegisterInterface 
{
    public function registerUser(string $user): string;
}

require 'classes/Login.php';
require 'classes/Register.php';

$login = new Login;
$register = new Register;
echo $login->loginUser('stefan') . '<br>';
echo $register->registerUser('marko');
<?php

    define('ROOT', dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR);
    define('APP_ROOT', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
    define('VIEW', APP_ROOT . 'Views' . DIRECTORY_SEPARATOR);
    define('MODEL', APP_ROOT . 'Models' . DIRECTORY_SEPARATOR);
    define('CONTROLLER', APP_ROOT . 'Controllers' . DIRECTORY_SEPARATOR);
    define('URL_ROOT', 'http://localhost/php-projects');
    define('SITE_NAME', 'MVC');

    // DB PARAMS
    define('DB_HOST', '127.0.0.1');
    define('DB_USER', 'root');
    define('DB_PASS', 'stefan95');
    define('DB_NAME', 'oop_login_register');

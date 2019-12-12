<?php

    use App\Libraries\Core;

    require_once '../app/bootstrap.php';

    $core = new Core;
    $core->loadControllersAndMethodsFromUrl();
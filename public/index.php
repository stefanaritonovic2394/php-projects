<?php

    use App\Libraries\Core;
    use App\Libraries\Router;
    use App\Libraries\Request;

    require_once '../app/bootstrap.php';

    $core = new Core;
    $core->loadControllersAndMethodsFromUrl();
//    $router = new Router(new Request);
//    $router->get('/getdata', function () {
//       return "<h1>Hello WORLD</h1>";
//    });
//    $router->post('/data', function($request) {
//        return json_encode($request->getRequestBody());
//    });
<?php

    use App\Libraries\Core;
    use App\Libraries\Router;
    use App\Libraries\Request;

    require_once '../app/bootstrap.php';

//    $core = new Core;
//    $core->loadControllersAndMethodsFromUrl();
    $request = new Request();
    $router = new Router();
    $router->add('', ['controller' => 'pages', 'action' => 'index']);
    $router->add('user/index', ['controller' => 'user', 'action' => 'index']);
    $router->add('user/create', ['controller' => 'user', 'action' => 'create']);
    $router->dispatch($request->getRequestUri());
//    Router::run('/', function(){
//        echo "HELLO";
//    });

//    Router::run('/show', 'user@index');
//    print_r($request->getRequestBody());
//    print_r($request->getRequestUri());
//    $router->get('/getdata', function () {
//       return "<h1>Hello WORLD</h1>";
//    });
//    $router->post('/data', function($request) {
//        return json_encode($request->getRequestBody());
//    });
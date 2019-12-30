<?php

    use App\Libraries\Core;
    use App\Libraries\Router;
    use App\Libraries\Request;

    require_once '../app/bootstrap.php';

//    $core = new Core;
//    $core->loadControllersAndMethodsFromUrl();
    $request = new Request();
    $router = new Router();
    $router->add('/user/index', 'UserController@index');
    $router->add('/user/create', 'UserController@create');
    $router->add('/user/store', 'UserController@store');
    $router->add('/user/edit/{id}', 'UserController@edit');
    $router->add('/user/update', 'UserController@update');
    $router->add('/user/{id}', 'UserController@show');
    $router->add('/user/delete/{id}', 'UserController@destroy');

    $router->add('/post/index', 'PostController@index');
    $router->add('/post/create', 'PostController@create');
    $router->add('/post/store', 'PostController@store');
    $router->add('/post/edit/{id}', 'PostController@edit');
    $router->add('/post/update', 'PostController@update');
    $router->add('/post/show', 'PostController@show');
    $router->add('/post/delete/{id}', 'PostController@destroy');
    $router->dispatch($request->getRequestUri());
//    print_r($request->getRequestBody());
//    print_r($request->getRequestUri());

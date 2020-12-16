<?php
require_once "../vendor/autoload.php";

use App\LoginController;

// Create new Plates instance
$templates = new League\Plates\Engine('../app/views');



$dispatcher = FastRoute\simpleDispatcher (function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/login', ['App\LoginController', 'printLogin', 'homepage']);
    $r->addRoute('GET', '/login/{id:\d+}', ['App\LoginController', 'printLogin', 'homepage']);
    $r->addRoute('GET', '/about', ['App\LoginController', 'printLogin', 'about']);
    $r->addRoute('GET', '/about/{id:\d+}', ['App\LoginController', 'printLogin', 'about']);
    // {id} must be a number (\d+)
    $r->addRoute('GET', '/user/{id:\d+}', ['App\LoginController', 'printLogin']);
    // The /{title} suffix is optional
    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});


// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $controller = new $handler[0];
        call_user_func([$controller, $handler[1]], $vars);
        
        //подключаем
        echo $templates->render($handler[2], ['name' => $var['id']]);
        d($vars);
        // ... call $handler with $vars
        break;
}




/*
if ($_SERVER['REQUEST_URI'] == "/"){
    echo $templates->render('homepage', ['name' => 'Stas']);
} elseif ($_SERVER['REQUEST_URI'] == "/about") {
    echo $templates->render('about');
}
*/





<?php
if( !session_id() ) @session_start();
require_once "../vendor/autoload.php";

use Delight\Auth\Auth;
use DI\ContainerBuilder;
use League\Plates\Engine;
use Aura\SqlQuery\QueryFactory;

$builder = new ContainerBuilder();
$builder->addDefinitions([

    Engine::class => function(){
        return new Engine('../app/views');
    },

    QueryFactory::class => function(){
        return new QueryFactory('mysql');
    },

    PDO::class => function(){
        return new PDO("mysql:host=127.0.0.1;dbname=level_32", "root", "root");
    },

    Auth::class => function($builder) {
        return new Auth ($builder->get("PDO"));
    }

]);

$containerDI = $builder->build();

$dispatcher = FastRoute\simpleDispatcher (function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/registration', ['App\Controllers\Registration', 'index']);
    $r->addRoute('POST', '/registration', ['App\Controllers\Registration', 'index']);

    $r->addRoute('GET', '/login', ['App\Controllers\Login', 'index']);
    $r->addRoute('POST', '/login', ['App\Controllers\Login', 'index']);

    $r->addRoute('GET', '/', ['App\Controllers\Users', 'index']);
    $r->addRoute('POST', '/', ['App\Controllers\Users', 'index']);
    
    $r->addRoute('GET', '/logout', ['App\Controllers\Users', 'logout']);

    $r->addRoute('GET', '/create', ['App\Controllers\Users', 'create']);
    $r->addRoute('POST', '/create', ['App\Controllers\Users', 'create']);

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
        $containerDI->call($handler, $vars);
        break;
}
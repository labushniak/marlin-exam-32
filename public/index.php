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

    $r->addRoute('GET', '/edit/{id:\d+}', ['App\Controllers\Users', 'edit']);
    $r->addRoute('POST', '/edit/{id:\d+}', ['App\Controllers\Users', 'edit']);

    $r->addRoute('GET', '/security/{id:\d+}', ['App\Controllers\Users', 'security']);
    $r->addRoute('POST', '/security/{id:\d+}', ['App\Controllers\Users', 'security']);

    $r->addRoute('GET', '/status/{id:\d+}', ['App\Controllers\Users', 'status']);
    $r->addRoute('POST', '/status/{id:\d+}', ['App\Controllers\Users', 'status']);

    $r->addRoute('GET', '/media/{id:\d+}', ['App\Controllers\Users', 'media']);
    $r->addRoute('POST', '/media/{id:\d+}', ['App\Controllers\Users', 'media']);

    $r->addRoute('GET', '/delete/{id:\d+}', ['App\Controllers\Users', 'delete']);

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
<?php
require_once "../vendor/autoload.php";

use Delight\Auth\Auth;
use DI\ContainerBuilder;
use League\Plates\Engine;

$builder = new ContainerBuilder;
$builder->addDefinitions([

    Engine::class => function(){
        return new Engine('../app/views');
    },

    PDO::class => function(){
        $driver = "mysql";
        $host = "127.0.0.1";
        $db_name = "marlin_users";
        $user_name = "root";
        $password = "root";

        return new PDO("mysql:host=127.0.0.1;dbname=marlin_users", "root", "root");
    },

    Auth::class => function() {
        return new Auth ($builder->get('PDO'));
    }

]);

$containerDI = $builder->build();

$dispatcher = FastRoute\simpleDispatcher (function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/registration', ['App\Registration', 'index']);
    $r->addRoute('POST', '/registration', ['App\Registration', 'validate', 'registration']);
    $r->addRoute('GET', '/login', ['App\LoginController', 'printLogin', 'login']);
    $r->addRoute('POST', '/login', ['App\LoginController', 'printLogin', 'login']);
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




/*
if ($_SERVER['REQUEST_URI'] == "/"){
    echo $templates->render('homepage', ['name' => 'Stas']);
} elseif ($_SERVER['REQUEST_URI'] == "/about") {
    echo $templates->render('about');
}
*/




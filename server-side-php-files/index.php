<?php

require 'vendor/autoload.php';

use App\Http\Routing\Router;
use App\Http\Routing\Route;
use App\Http\Request;
use App\Container\Container;

header("Access-Control-Allow-Origin: http://localhost:4200");

$router = new Router();

$router->register(new Route('#mail/(?<method>getMail)#', Request::METHOD_GET, App\Mail::class));
$router->register(new Route('#mail/(?<method>transferMail)#', Request::METHOD_GET, App\Mail::class));
$router->register(new Route('#mail/(?<method>unreadMail)#', Request::METHOD_GET, App\Mail::class));

$route = $router->resolve(Request::createFromGlobals());
$controller = $route->getTarget();
$container = new Container();
$instance = $container->make($controller);
$result = $container->call($controller, 'action');
// $method = $route->getAction();
// $result = $instance->$method();

echo $result;
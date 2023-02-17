<?php
require_once '../app/Config/config.php';
require_once '../app/Core/Router.php';
require_once '../app/Controllers/IndexController.php';

use App\Controllers\IndexController;

$router = new Router();
$router->add(array(
    'name'=>'home',
    'path'=>'/^\/$/',
    'action'=>[IndexController::class, 'IndexAction']
));
$router->add(array(
    'name'=>'saludo',
    'path'=>'/^\/saludo\/([a-zñáéíóú]+)$/',
    'action'=>[IndexController::class, 'SaludoAction']
));
$router->add(array(
    'name'=>'saludo',
    'path'=>'/^\/numeros\/$/',
    'action'=>[IndexController::class, 'ParesAction']
));
$router->add(array(
    'name'=>'saludo',
    'path'=>'/^\/numeros\/([0-9]+)$/',
    'action'=>[IndexController::class, 'Pares2Action']
));
$request=str_replace(DIRBASEURL,'',$_SERVER['REQUEST_URI']);
$route =$router->match($request);
if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
}
else {
    echo "No route";
}
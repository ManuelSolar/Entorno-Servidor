<?php
header('Content-Type: application/json');

require "../vendor/autoload.php";

include_once "../app/controllers/contactosController.php";
include_once "../app/controllers/authController.php";

Use Firebase\JWT\JWT;
Use Firebase\JWT\Key;

if(strpos($_SERVER['REQUEST_URI'], '/contactos') !== false){
    $api = new ContactosController();
    $auth = new AuthController();
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            $token = $auth->getToken();
            if($auth->checkToken($token)){
                if(isset($_GET['id'])){
                    $api->getById($_GET['id']);
                }else{
                    $api->getAll();
                }
            }else{
                $api->error('No tienes permisos');
            }
            break;
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'), true);
            $token = $auth->getToken();
            if($auth->checkToken($token)){
                $api->set($_POST);
            }else{
                $api->error('No tienes permisos');
            }
            break;
            
        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'), true);
            $token = $auth->getToken();
            if($auth->checkToken($token)){
                $api->update($_PUT);
            }else{
                $api->error('No tienes permisos');
            }
            break;
           
        case 'DELETE':
            $_DELETE = json_decode(file_get_contents('php://input'), true);
            $token = $auth->getToken();
            if($auth->checkToken($token)){
                $api->delete($_DELETE['id']);
            }else{
                $api->error('No tienes permisos');
            }
            break;
            
        default:
            $api->error('Método no soportado');
            break;
    }
    exit;
}else if($_SERVER['REQUEST_URI'] == '/login'){
    $api = new AuthController();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $api->login();
    }else{
        $api->error('Método no soportado');
    }
    exit;
}else{
    echo 'Ruta no soportada';
}






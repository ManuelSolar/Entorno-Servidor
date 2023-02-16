<?php
header('Content-Type: application/json');

include_once "../app/controllers/contactosController.php";

switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if(isset($_GET['id'])){
            $api = new ContactosController();
            $api->getById($_GET['id']);
        }else{
            $api = new ContactosController();
            $api->getAll();
        }
        break;
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        $api = new ContactosController();
        $api->set($_POST);
        break;
        
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $api = new ContactosController();
        $api->update($_PUT);
        break;
       
    case 'DELETE':
        $_DELETE = json_decode(file_get_contents('php://input'), true);
        $api = new ContactosController();
        $api->delete($_DELETE['id']);
        break;
        
    default:
        $api->error('Método no soportado');
        break;
}


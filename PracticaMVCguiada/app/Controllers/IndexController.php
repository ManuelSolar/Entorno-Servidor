<?php
namespace App\Controllers;

include_once '../app/Controllers/BaseController.php';

class IndexController extends BaseController{
    public function IndexAction(){
        $data = array('message' => 'Hola Mundo');
        $this-> renderHTML('../views/index_view.php',$data);
    }

    //saludo personalizado

    public function SaludoAction($request){                 //obtener el nombre despues de la barra saludo/
        $nombre = explode('/',$request);                    
        $data = array('message' => 'Hola Mundo', 'nombre' => $nombre[2]);
        
        $this-> renderHTML('../views/saludo_view.php',$data);
    }

    // muestra los 10 primeros números pares

    public function ParesAction(){
        
        $data = array('message' => 'Hola Mundo');
        $this-> renderHTML('../views/pares_view.php',$data);
    }

    // muestra un numero determinado de pares

    public function Pares2Action($request){
        $numero = explode('/',$request);
        $data = array('message' => 'Hola Mundo', 'numero' => $numero[2]);
        $this-> renderHTML('../views/pares2_view.php',$data);
    }


}
<?php

include_once "../app/models/Contactos.php";

class ContactosController{

    private $error;
    
    function getAll(){
        $contacto = new Contactos();
        $contactos = $contacto->get();
  
        if(count($contactos) > 0){
            $this->printJSON($contactos);
        }else{
            $this->error('No hay elementos');
        } 
    }

    function getById($id){
        $contacto = new Contactos();
        $contactos = $contacto->get($id);
  
        if(count($contactos) == 1){
            $this->printJSON($contactos);
        }else{
            $this->error('No hay elementos');
        } 
    }

    function set($item){
        $contacto = new Contactos();
        $contacto->set($item);
        $this->exito('Contacto creado');
    }

    function update($item){
        $contacto = new Contactos();
        $contacto->edit($item);
        $this->exito('Contacto actualizado');
    }

    function delete($id){
        $contacto = new Contactos();
        $contacto->delete($id);
        $this->exito('Contacto eliminado');
    }

    function error($mensaje){
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>'; 
    }

    function exito($mensaje){
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>'; 
    }

    function printJSON($array){
        echo '<code>'.json_encode($array).'</code>';
    }

}
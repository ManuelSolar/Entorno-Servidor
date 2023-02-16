<?php

include_once "DBAbstractModel.php";

class Contactos extends DBAbstractModel{
    /*CONSTRUCCIÓN DEL MODELO SINGLETON*/
    private static $instancia;
    public static function getInstancia(){
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    public function __clone(){
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }

    private $id;
    private $nombre;
    private $telefono;
    private $email;

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function set($user_data=array()) {
        foreach ($user_data as $campo=>$value) {
            $$campo = $value;
        }
        $this->query = "INSERT INTO contacts VALUES(id, :nombre, :telefono, :email, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $this->parametros['nombre']= $nombre;
        $this->parametros['telefono']= $telefono;
        $this->parametros['email']= $email;
        $this->get_results_from_query();
        $this->mensaje = 'Contacto agregado correctamente';
    }

    public function edit($user_data=array()) {
        foreach ($user_data as $campo=>$value) {
            $$campo = $value;
        }
        $this->query = "UPDATE contacts SET nombre= :nombre, telefono= :telefono, email= :email, updated_at = CURRENT_TIMESTAMP WHERE id= :id";
        $this->parametros['nombre']= $nombre;
        $this->parametros['telefono']= $telefono;
        $this->parametros['email']= $email;
        $this->parametros['id']= $id;
        $this->get_results_from_query();
        $this->mensaje = 'Contacto editado correctamente';
    }

    public function delete($id=''){
        $this->query = "DELETE FROM contacts WHERE id = :id";
        $this->parametros['id']=$id;
        $this->get_results_from_query();
        $this->mensaje = 'Contacto eliminado correctamente';
    }

    public function get($id='') {
        if($id != ''){
            $this->query = "SELECT * FROM contacts WHERE id = :id";
            $this->parametros['id']=$id;
        }else{
            $this->query = "SELECT * FROM contacts";
        }
        $this->get_results_from_query();
        return $this->rows;
    }


}
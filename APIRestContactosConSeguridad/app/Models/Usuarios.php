<?php

include_once "DBAbstractModel.php";

class Usuarios extends DBAbstractModel{
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
    private $usuario;
    private $password;

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getPassword() {
        return $this->password;
    }

    public function login($usuario, $password) {
        
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";
        $this->parametros['usuario']= $usuario;
        $this->parametros['password']= $password;
        $this->get_results_from_query();

        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $property=>$value) {
                $this->$property = $value;
            }
            $this->mensaje = 'Usuario logueado correctamente';
        }
        else {
            $this->mensaje = 'Usuario o contraseña incorrectos';
        }

        return $this->rows[0]??null;

    }

    public function get(){}

    public function set(){}

    public function edit(){}

    public function delete(){}
}
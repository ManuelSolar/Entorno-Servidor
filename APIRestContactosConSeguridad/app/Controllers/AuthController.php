<?php

include_once "../app/models/Usuarios.php";

require "../vendor/autoload.php";


use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class AuthController{
    
        private $error;
        
        function login(){
            $input = json_decode(file_get_contents('php://input'), true);
            $usuario = new Usuarios();
            $usuario->login($input['usuario'], $input['password']);
            if($usuario->getUsuario()){
               $issuer_claim = "http://apirestcontactos.local"; // this can be the servername
                $audience_claim = "http://apirestcontactos.local";
                $issuedat_claim = time(); // issued at
                $notbefore_claim = time(); //not before in seconds
                $expire_claim = $issuedat_claim + 3600; // expire time in seconds
                $token = array(
                    "iss" => $issuer_claim,
                    "aud" => $audience_claim,
                    "iat" => $issuedat_claim,
                    "nbf" => $notbefore_claim,
                    "exp" => $expire_claim,
                    "data" => array(
                          "usuario" => $usuario->getUsuario(),
                          "password" => $usuario->getPassword()
                    )
                );

                $jwt =  JWT::encode($token, KEY,'HS256');
                $resultado = array(
                    "mensaje" => "Logueado con éxito.",
                    "token" => $jwt,
                );
                $this->printJSON($resultado);
            }else{
                $this->error('Usuario o contraseña incorrectos');
            }
        }

        //como almacenar un token


        public function getToken(){
            $headers = apache_request_headers();
            $authorization = $headers['Authorization'];
            $authorizationArray = explode(' ', $authorization);
            $token = $authorizationArray[1];
            $decodedToken = JWT::decode($token, new key(KEY, 'HS256'));
            return $decodedToken;
        }

        //comprobar si el token es válido

        public function checkToken(){
            $decodedToken = $this->getToken();
            if($decodedToken->exp < time()){
                $this->error('Token caducado');
                return false;
            }else{
                $this->exito('Token válido');
                return true;
            }
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
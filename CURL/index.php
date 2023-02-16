<?php

$headers = apache_request_headers();

$authorization = $headers['Authorization'];

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vYXBpcmVzdGNvbnRhY3Rvcy5sb2NhbCIsImF1ZCI6Imh0dHA6Ly9hcGlyZXN0Y29udGFjdG9zLmxvY2FsIiwiaWF0IjoxNjc2NTYyODYzLCJuYmYiOjE2NzY1NjI4NjMsImV4cCI6MTY3NjU2NjQ2MywiZGF0YSI6eyJ1c3VhcmlvIjoiYWRtaW4iLCJwYXNzd29yZCI6ImFkbWluIn19.F9Qiv7RZ2-vdwxoi3B6qMDfdEmJIEHBGnbers2hsuRc';

$authorization = 'Authorization: Bearer '. $token;

//login CURL FUNCIONA
$ch = curl_init();

$array = array('usuario' => 'admin', 'password' => 'admin');

$field= json_encode($array);

curl_setopt($ch, CURLOPT_URL, "http://apirestcontactos.local/login");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if(curl_errno($ch)){
    echo 'Error:' . curl_error($ch);
}else{
    echo $response;
}

curl_close($ch);

//contactos GETALL CURL FUNCIONA

$ch = curl_init();


curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
curl_setopt($ch, CURLOPT_URL, "http://apirestcontactos.local/contactos");

$response = curl_exec($ch);

if(curl_errno($ch)){
    echo 'Error:' . curl_error($ch);
}else{
    echo $response;
}

curl_close($ch);

//contactos GET CURL FUNCIONA

$ch = curl_init();

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

curl_setopt($ch, CURLOPT_URL, "http://apirestcontactos.local/contactos/?id=". $_GET['id']);

$response = curl_exec($ch);

if(curl_errno($ch)){
    echo 'Error:' . curl_error($ch);
}else{
    echo $response;
}

curl_close($ch);

//contactos POST CURL FUNCIONA

$ch = curl_init();

$array = array('nombre' => 'Juan', 'telefono' => '123456789', 'email' => 'hola@gmail.com');

$field= json_encode($array);

var_dump($field);
print_r($field);

$data = http_build_query($array);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
curl_setopt($ch, CURLOPT_URL, "http://apirestcontactos.local/contactos");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if(curl_errno($ch)){
    echo 'Error:' . curl_error($ch);
}else{
    echo $response;
}

curl_close($ch);

//contactos PUT CURL FUNCIONA

$ch = curl_init();

$array = array('id' => '6', 'nombre' => 'Felix', 'telefono' => '123456789', 'email' => 'hola@gmail.com');

$field= json_encode($array);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
curl_setopt($ch, CURLOPT_URL, "http://apirestcontactos.local/contactos");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if(curl_errno($ch)){
    echo 'Error:' . curl_error($ch);
}else{
    echo $response;
}

curl_close($ch);

//contactos DELETE CURL FUNCIONA

$ch = curl_init();

$array = array('id' => '10');

$field= json_encode($array);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
curl_setopt($ch, CURLOPT_URL, "http://apirestcontactos.local/contactos");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if(curl_errno($ch)){
    echo 'Error:' . curl_error($ch);
}else{
    echo $response;
}

curl_close($ch);

?>
<?php
require("../../config.php");
include("../gets.php");
include("enviarNotificacion.php");
$sesionId = session_id();

$respuesta = $_POST["respuesta"];
$id = $_POST["id"];
$clienteId = $_POST["clienteId"];

if($respuesta == ""){
  echo "1";    
}else{
  //Realizar POST
  $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/respuesta?sesion=$sesionId";

  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $headers = array(
      "Accept: application/json",
      "Content-Type: application/json",
  );
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  
  $data = <<<DATA
  {
      "respuesta": "$respuesta",
      "mensajeId": $id
  }
  DATA;
  
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);    

  $resp = curl_exec($curl);

  $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  curl_close($curl);
  echo $httpCode;

  notificarCliente($clienteId, "El administrador ha contestado tu mensaje!", $sesionId);
}




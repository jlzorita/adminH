<?php
require("../../config.php");
include("../gets.php");
$sesionId = session_id();

$id = $_POST["id"];


//Realizar DELETE
$url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/notificacion/eliminar/$id?sesion=$sesionId";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                
$resp = curl_exec($curl);

$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);	
echo $httpCode;

?>
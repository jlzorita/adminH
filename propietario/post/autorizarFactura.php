<?php
require("../../config.php");
include("../gets.php");
$sesionId = session_id();


$id = $_POST["id"];


//Realizar POST
$url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/factura/autorizar/$id?sesion=$sesionId";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$resp = curl_exec($curl);

$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);	

if($httpCode == "200"){
    echo $httpCode;
}
?>
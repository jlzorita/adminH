<?php
require("../../config.php");
include("enviarNotificacion.php");
//include("../gets.php");
$sesionId = session_id();

$titulo = $_POST["titulo"];
$mensaje = $_POST["content"];
$fechaInicio =  $_POST["fechaInicio"];
$fechaFin =  $_POST["fechaFin"];
$fechaEvento = $_POST["fechaEvento"];    
$comunidadId =  $_SESSION["comunidadId"];


if($fechaInicio == "" || $fechaFin == "" || $fechaEvento == ""){
    echo "5";
}elseif($titulo == ""){
    echo "3";
}elseif($mensaje == ""){
    echo "4";
}elseif($fechaFin < $fechaInicio){
    echo "1";
}elseif($fechaEvento < $fechaFin){
    echo "2";
}else{

    //Realizar POST
    $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/publicacion/crear?sesion=$sesionId";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $mensaje = str_replace('"','\"',$mensaje);
    $mensaje = str_replace(array("\r", "\n"), '', $mensaje);

    $data = <<<DATA
    {
        "titulo": "$titulo",
        "mensaje": "$mensaje",
        "fechaInicio": "$fechaInicio",
        "fechaFin": "$fechaFin",
        "fechaEvento": "$fechaEvento",
        "comunidadId": $comunidadId
    }
    DATA;
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);    

    $resp = curl_exec($curl);

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    notificarComunidad("Nueva publicación en el tablón!", $sesionId);

    echo $httpCode;
}
?>
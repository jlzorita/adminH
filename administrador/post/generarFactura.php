<?php
require("../../config.php");
include("../gets.php");
include("enviarNotificacion.php");
$sesionId = session_id();

$presupuesto = $_POST["presupuesto"];
$partida = $_POST["partida"];
$proveedor = $_POST["proveedor"];
$fechaFactura =  $_POST["fechaFactura"];
$numFactura =  $_POST["numFactura"];
$descripcion =  $_POST["descripcion"];
$importe = $_POST["importe"];
$comunidadId = $_SESSION["comunidadId"];

if($fechaFactura == ""){
    echo "1";
}elseif($descripcion == ""){
    echo "2";
}elseif($importe == ""){
    echo "3";    
}else{

    //Realizar POST
    $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/factura/crear?sesion=$sesionId";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    $data = <<<DATA
    {
        "fechaFactura": "$fechaFactura",
        "numeroFactura": "$numFactura",
        "descripcion": "$descripcion",
        "importe": $importe,
        "proveedorId": $proveedor,
        "comunidadId": $comunidadId,
        "partidaId": $partida
    }
    DATA;
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);    

    $resp = curl_exec($curl);

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if(requiereAutorizacion($presupuesto, $partida))
        notificarCliente(getPresidente(), "Tienes una nueva factura a autorizar!", $sesionId);

    echo $httpCode;
}
?>
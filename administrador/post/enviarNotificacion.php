<?php 
require("../../config.php");
function notificarCliente($id, $mensaje, $sesion){
    $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/notificacion/crear/?sesion=$sesion";

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
        "mensaje": "$mensaje",
        "clienteId": $id
    }
    DATA;
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);    

    $resp = curl_exec($curl);

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    return $httpCode;
}    


function notificarComunidad($mensaje, $sesion){
    $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/comunidad/clientes/$_SESSION[comunidadId]?sesion=$sesion";
    $clientes = json_decode(file_get_contents($url), true);

    foreach($clientes as $cliente){
        notificarCliente($cliente["id"], $mensaje, $sesion);
    }
}
?>
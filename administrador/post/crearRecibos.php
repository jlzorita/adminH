<?php
require("../../config.php");
include("../gets.php");
include("enviarNotificacion.php");
$sesionId = session_id();

$concepto = $_POST["concepto"];
$fechaRecibo = $_POST["fechaRecibo"];
$comunidadId = $_SESSION["comunidadId"];

if($fechaRecibo == ""){
  echo "1";
}elseif($concepto == ""){
  echo "2";
}else{
  foreach(getEntidadesComunidad() as $entidad){
      //Realizar POST
      $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/recibo/crear?sesion=$sesionId";

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

      $headers = array(
          "Accept: application/json",
          "Content-Type: application/json",
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

      $importe = $_POST["importe".$entidad["id"]];
      $entidadId = $entidad["id"];
      
      $data = <<<DATA
      {
          "fechaRecibo": "$fechaRecibo",
          "concepto": "$concepto",
          "importe": "$importe",
          "entidadId": $entidadId,
          "comunidadId": $comunidadId
      }
      DATA;      
      
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);    
      $resp = curl_exec($curl);        
      curl_close($curl);        
  }

  notificarComunidad("Nueva cuota creada!", $sesionId);
  echo "200";
}

?>
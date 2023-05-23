<?php
//require("../config.php");
$_SESSION["clienteId"] = codiCliente();

if(!isset($_SESSION["entidadCom"])) $_SESSION["entidadCom"] = 0;
if(!isset($_SESSION["entidadId"])) $_SESSION["entidadId"] = entidadesCliente()[0]["entidad"]["id"];
if(!isset($_SESSION["comunidadId"])) $_SESSION["comunidadId"] = comunidadPorEntidad($_SESSION["entidadId"]);

function logout(){
    $url = "http://$GLOBALS[host]:$GLOBALS[puertoUser]/logout/$_SESSION[usuario]";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);    
    $resp = curl_exec($curl);
}

function numNotificaciones(){   
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/notificacion/$_SESSION[usuario]?sesion=$sessionId";   
   $data = json_decode(file_get_contents($url), true);
   if($data != null) return sizeof($data);    
   else return 0;
}

function notificaciones(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/notificacion/$_SESSION[usuario]?sesion=$sessionId";
   return json_decode(file_get_contents($url), true);    
 }

 function datosUsuario(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/usuario/$_SESSION[usuario]?sesion=$sessionId";
   return json_decode(file_get_contents($url), true);    
 }

 function codiCliente(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/usuario/$_SESSION[usuario]?sesion=$sessionId";
   $data = json_decode(file_get_contents($url), true);    
   return $data["id"];
 }

 function entidadesCliente(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/comunidades/$_SESSION[clienteId]?sesion=$sessionId";
   return json_decode(file_get_contents($url), true);
 }

 function comunidadPorEntidad($entidadId){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/comunidadEntidad/$entidadId?sesion=$sessionId";
   return json_decode(file_get_contents($url), true);    
 }

 function datosComunidad(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/comunidad/$_SESSION[comunidadId]?sesion=$sessionId";
   return json_decode(file_get_contents($url), true);    
 }

 function publicacionesComunidad(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/publicacion/$_SESSION[comunidadId]?sesion=$sessionId";
   return json_decode(file_get_contents($url), true);    
}

function presupuestosComunidad(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/presupuesto/$_SESSION[comunidadId]?sesion=$sessionId";
   return json_decode(file_get_contents($url), true);    
}

function partidasPresupuesto($presupuesto){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/presupuesto/partidas/$presupuesto?sesion=$sessionId";
   return json_decode(file_get_contents($url), true);
}

function facturasPagadasPartida($partida){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/factura/$partida?pendientes=no&sesion=$sessionId";
   $curl = curl_init($url);
   curl_setopt($curl,  CURLOPT_RETURNTRANSFER, TRUE);
   curl_exec($curl);
   $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
   curl_close($curl);    

   if($httpCode == "200"){
      return $data = json_decode(file_get_contents($url), true);                
   }else{
      return null;
   }
}

function todasFacturasPartida($partida){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/factura/$partida?pendientes=si&sesion=$sessionId";
   $curl = curl_init($url);
   curl_setopt($curl,  CURLOPT_RETURNTRANSFER, TRUE);
   curl_exec($curl);
   $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
   curl_close($curl);    

   if($httpCode == "200"){
      return $data = json_decode(file_get_contents($url), true);                
   }else{
      return null;
   }
}


function totalIngresosComunidad($anualidad){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/recibo/$_SESSION[comunidadId]?anualidad=$anualidad&sesion=$sessionId";
   $ingresos = json_decode(file_get_contents($url), true);
   $totalIngresos = 0;

   foreach($ingresos as $ingreso){
      $totalIngresos = $totalIngresos + $ingreso["importe"];
   }
   return $totalIngresos;
}

function facturasPendientes(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/factura/pendientes/$_SESSION[comunidadId]?sesion=$sessionId";
   $curl = curl_init($url);
   curl_setopt($curl,  CURLOPT_RETURNTRANSFER, TRUE);
   curl_exec($curl);
   $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
   curl_close($curl);    

   if($httpCode == "200"){
      return $data = json_decode(file_get_contents($url), true);                
   }else{
      return null;
   }
}

function facturasPendientesAutorizar(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/factura/autorizar/pendientes/$_SESSION[comunidadId]?sesion=$sessionId";
   $curl = curl_init($url);
   curl_setopt($curl,  CURLOPT_RETURNTRANSFER, TRUE);
   curl_exec($curl);
   $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
   curl_close($curl);    

   if($httpCode == "200"){
      return $data = json_decode(file_get_contents($url), true);                
   }else{
      return null;
   }
}

function nombreCliente($id){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/cliente/id/$id?sesion=$sessionId";
   return json_decode(file_get_contents($url), true)["nombre"];       
}

function recibosPendientes(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/recibo/pendientes/entidad/$_SESSION[entidadId]?sesion=$sessionId";
   $curl = curl_init($url);
   curl_setopt($curl,  CURLOPT_RETURNTRANSFER, TRUE);
   curl_exec($curl);
   $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
   curl_close($curl);    

   if($httpCode == "200"){
      return $data = json_decode(file_get_contents($url), true);                
   }else{
      return null;
   }
}


function mensajesNoContestados(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/mensaje/usuario/$_SESSION[usuario]?tipo=NOLEIDO&sesion=$sessionId";

   $data = json_decode(file_get_contents($url), true);   

   if(sizeof($data) == 0) return null;
   else return $data;
   
}

function mensajesContestados(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/mensaje/usuario/$_SESSION[usuario]?tipo=CONTESTADOS&sesion=$sessionId";
   $curl = curl_init($url);
   curl_setopt($curl,  CURLOPT_RETURNTRANSFER, TRUE);
   curl_exec($curl);
   $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
   curl_close($curl);    

   if($httpCode == "200"){
      return $data = json_decode(file_get_contents($url), true);                
   }else{
      return null;
   }
}


function partidaFactura($facturaId){

   $presupuestos = presupuestosComunidad($_SESSION["comunidadId"]);
   foreach($presupuestos as $presupuesto){
      $partidas = partidasPresupuesto($presupuesto["id"]);
      if($partidas != null){
         foreach($partidas as $partida){
            $facturas = todasFacturasPartida($partida["id"]);
            if($facturas != null){
               foreach($facturas as $factura){               
                  if($factura["id"] == $facturaId){
                     return $partida["nombre"];
                  }
               }
            }
         }
      }
   }
   return null;
}

function getDetalleFactura($facturaId){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/factura/detalle/$facturaId?comunidadId=$_SESSION[comunidadId]&sesion=$sessionId";
   return json_decode(file_get_contents($url), true);
}

?>
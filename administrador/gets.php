<?php
//require("../config.php");

if(!isset($_SESSION["entidadCom"])) $_SESSION["entidadCom"] = 0;
if(!isset($_SESSION["comunidadId"])) $_SESSION["comunidadId"] = comunidadesAdministrador()[0]["id"];

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

function datosComunidad(){
   $sessionId = session_id();
    $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/comunidad/$_SESSION[comunidadId]?sesion=$sessionId";
    return json_decode(file_get_contents($url), true);    
 }

 function publicacionesComunidad(){   
   $sessionId = session_id();
    $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/publicacion/$_SESSION[comunidadId]?sesion=$sessionId";
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

 function comunidadesAdministrador(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/comunidades/administrador/$_SESSION[usuario]?sesion=$sessionId";
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
   $curl = curl_init($url);

   curl_setopt($curl,  CURLOPT_RETURNTRANSFER, TRUE);
   curl_exec($curl);    
   $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
   curl_close($curl);    
 
   $totalIngresos = 0;

   if($httpCode == "200"){      
   $ingresos = json_decode(file_get_contents($url), true);
     foreach($ingresos as $ingreso){
        $totalIngresos = $totalIngresos + $ingreso["importe"];
     }      
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

 function nombreCliente($id){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/cliente/id/$id?sesion=$sessionId";
   return json_decode(file_get_contents($url), true)["nombre"];
 }

 function usuarioCliente($id){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/cliente/id/$id?sesion=$sessionId";
   return json_decode(file_get_contents($url), true)["usuario"];
}

 function getProveedores(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/proveedores/?sesion=$sessionId";
   return json_decode(file_get_contents($url), true);
 }

function getEntidadesComunidad(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/comunidad/entidades/$_SESSION[comunidadId]?sesion=$sessionId";
   return json_decode(file_get_contents($url), true);
}

function numEntidadesComunidad(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/comunidad/entidades/$_SESSION[comunidadId]?sesion=$sessionId";
   $numEntidades = 0;
   $entidades = json_decode(file_get_contents($url), true);
   foreach($entidades as $entidad){
      $numEntidades++;
   }
   return $numEntidades;
}

function requiereAutorizacion($presupuesto, $partidaId){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/presupuesto/partidas/$presupuesto?sesion=$sessionId";
   $partidas = json_decode(file_get_contents($url), true);

   foreach($partidas as $partida){
      if($partida["id"] == $partidaId)
         return $partida["autorizacion"];
   }
   return false;
 }

function getPresidente(){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/comunidad/$_SESSION[comunidadId]?sesion=$sessionId";
   $comunidad = json_decode(file_get_contents($url), true);
   return $comunidad["presidenteId"];
}

function mensajesNoContestadosComunidad(){   
   $sessionId = session_id();   
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/mensaje/comunidad/$_SESSION[comunidadId]?sesion=$sessionId";
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

function getDetalleFactura($facturaId){
   $sessionId = session_id();
   $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/factura/detalle/$facturaId?comunidadId=$_SESSION[comunidadId]&sesion=$sessionId";
   return json_decode(file_get_contents($url), true);
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
<?php
require("../../config.php");
include("../gets.php");

$sesionId = session_id();

$titulo = $_POST["titulo"];
$mensaje = $_POST["mensaje"];
$cliente = $_SESSION["clienteId"];
$comunidadId = $_SESSION["comunidadId"];
$administrador = datosComunidad()["administrador"];

if($titulo == ""){
    echo "noTitulo";
}elseif(empty($mensaje)){
    echo "noMensaje";
}elseif($mensaje == ""){
    echo "hayMensajes";
}else{

    //Realizar POST
    $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/mensaje?sesion=$sesionId";

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
        "titulo": "$titulo",
        "mensaje": "$mensaje",
        "clienteId": $cliente,
        "comunidadId": $comunidadId,
        "administrador": "$administrador"        
    }
    DATA;        

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);    
    $resp = curl_exec($curl);

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);	
    
    if($httpCode == "500"){
        echo $httpCode;
    }else{

    
        $mensajeNoContestado = mensajesNoContestados();
        if($mensajeNoContestado != null){  
            ?>
            <h2><b>Consulta pendiente de respuesta</b></h2>
                
                <table style="width:600px;border-collapse: collapse;">
                    <tr>
                        <td style="border:1px black solid;width:120px;text-align:center;background-color:#FFBD35" rowspan="3"> 
                            <b>Consulta</b>
                        </td>
                        <td style="padding:5px 5px;border:1px black solid;font-weight:bold;" > 
                            <?php echo $mensajeNoContestado[0]["titulo"]; ?>
                        </td>
                    </tr>
                    <tr>                
                        <td style="padding:5px 5px;border-right:1px black solid" > 
                            <?php echo $mensajeNoContestado[0]["mensaje"]; ?>
                        </td>
                    </tr>
                    <tr>                
                        <td style="font-size:10pt;border-right:1px black solid;text-align:right;
                        padding:0px 10px;font-weight:bold" > 
                            <?php 
                                echo substr($mensajeNoContestado[0]["fechaM"],8,2);
                                echo "/";
                                echo substr($mensajeNoContestado[0]["fechaM"],5,2);
                                echo "/";
                                echo substr($mensajeNoContestado[0]["fechaM"],0,4);
                                echo " ";
                                echo substr($mensajeNoContestado[0]["fechaM"],11,5);
                                echo "h ";
                                echo $_SESSION["usuario"];
                            ?>
                        </td>
                    </tr>
                </table>
            <?php

        }
    }
}

?>
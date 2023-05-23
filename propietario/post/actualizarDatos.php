<?php
require("../../config.php");
$sesionId = session_id();

if(empty($_POST["direccion"])) { 
    echo "noDireccion";
}elseif(empty($_POST["cp"])) {         
    echo "noCp";
}elseif(empty($_POST["municipio"])) {         
        echo "noMunicipio";    
}elseif(empty($_POST['provincia'])) {         
    echo "noProvincia";
}else{

    $clienteId = $_POST["clienteId"];
    $direccion = $_POST["direccion"];
    $cp = $_POST["cp"];
    $municipio = $_POST["municipio"];
    $provincia = $_POST["provincia"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    
    //Realizar POST
    $url = "http://$GLOBALS[host]:$GLOBALS[puertoCrm]/usuario/actualizar?sesion=$sesionId";

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
        "id": "$clienteId",
        "direccion": "$direccion",
        "cp": "$cp",
        "municipio": "$municipio",
        "provincia": "$provincia",
        "telefono": "$telefono",
        "email": "$email"
    }
    DATA;        

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);    
    $resp = curl_exec($curl);

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);	

    echo $httpCode;
}
?>

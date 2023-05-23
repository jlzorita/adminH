<?php
require("config.php");
if(empty($_POST['usuario'])) { 
    echo "noNombre";

}elseif(empty($_POST['password'])) {
    echo "noPassword";

}else{
    $usuario=$_POST['usuario'];
    $password=$_POST['password'];

    //Realizar POST
    $url = "http://$GLOBALS[host]:$GLOBALS[puertoUser]/login";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    //Nos aseguramos que regeneramos el código de sesión al rehacer login
    session_regenerate_id();
    $sesion = session_id();
    
    $data = <<<DATA
    {
        "usuarioData":{        
            "usuario": "$usuario",
            "password": "$password"
        },

        "sesion": "$sesion"
    }
    DATA;        

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);    
    $resp = curl_exec($curl);

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);	
        
    //NIVEL 0: Propietario
    //NIVEL 1: Presidente
    //NIVEL 2: Administrador  
    if($resp >=0 && $resp <=2){
        $_SESSION["usuario"] = $usuario;
        $_SESSION["nivel"] = $resp;     
        echo $resp;
        
    }else{

        session_destroy();
        echo $httpCode;
    }
}
?>
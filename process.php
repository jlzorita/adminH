<?php 
    if(empty($_POST['usuario'])) { 
        echo "noN";

    }elseif(empty($_POST['password'])) {
        echo "noP";

    }else{
        $usuario=$_POST['usuario'];
        $password=$_POST['password'];

        //Realizar POST
        $url = "http://localhost:18081/login";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        session_destroy();
        session_start();
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
        curl_close($curl);	

        if($resp >= 0 && $resp <= 2){                  
            $_SESSION["usuario"] = $usuario;
            $_SESSION["nivel"] = $resp;            
            //Mostrar otra página
            header("Location: principal.php");

        }else{
            echo "\n$resp\n\n";
            session_destroy();
        }
    }
?>
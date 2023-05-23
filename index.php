<html>

    <head>
        <title>ADMINH</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <link href="estilos.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" type="image/ico" href="imagenes/adminh.ico"/>

        <script>
        function comprobarDatos(){	
            
            $.ajax({
            type: 'POST',
            url: 'process.php',
            data: $('#form1').serialize(),

            success: function(respuesta) {
                document.getElementById("retorno").style.color = "red";
                document.getElementById("retorno").style.fontWeight = "bold";

                if(respuesta == "noNombre"){                                
                    document.getElementById("retorno").innerHTML = "Introduce un nombre de usuario.";
                }else if(respuesta == "noPassword"){
                    document.getElementById("retorno").innerHTML = "Introduce una contraseña.";
                }else if (respuesta.includes("401")){
                    document.getElementById("retorno").innerHTML = "Usuario o contraseña incorrectos.";
                }else if(respuesta == 0 || respuesta == 1){
                    location.href = 'propietario/index.php'; 
                }else if(respuesta == 2){
                    location.href = 'administrador/index.php';
                }
            }
            });
        }
        </script>
    </head>
    <body>
        <div style="text-align:center;padding:30px">

            <img src="imagenes/logo1.png" style="width:200px"/><br/><br/>
            Introduce tus datos de usuario para acceder a la aplicación:<br/><br/>
            
            <form onsubmit="comprobarDatos(); return false" id="form1">
            <p>           
            <label><b>Usuario</b></label>
                <input type="text" name="usuario" />
            </p>
            <p>
                <label><b>Contraseña</b></label>
                <input type="password" name="password" />
            </p>
            <p>
                <input type="submit" value="Acceder" />
            </p>
                <div id="retorno"></div>
            </form>
        </div>
    </body>
</html>
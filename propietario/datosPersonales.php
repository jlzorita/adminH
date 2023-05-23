<?php
require("../config.php");
include("gets.php");
$user = datosUsuario();
$nombre = $user["nombre"];
$nif = $user["nif"];
$direccion = $user["direccion"];
$cp = $user["cp"];
$municipio = $user["municipio"];
$provincia = $user["provincia"];
$iban = $user["iban"];
$email = $user["email"];
$telefono = $user["telefono"];
$clienteId = $_SESSION["clienteId"];
    
?>
<script>
    document.getElementById("datosPersonales").style.background = "#FFDD97";
    document.getElementById("publicacionesTablon").style.background = "";
    document.getElementById("estadoContable").style.background = "";
    document.getElementById("recibosPendientes").style.background = "";
    document.getElementById("consultaAdministrador").style.background = "";
    document.getElementById("autorizarFacturas").style.background = "";
</script>

<h2><b>Datos personales</b></h2>

<form onsubmit="updateUsuario(); return false" id="form1">
        <p>           
           <label><b>Nombre</b></label>
            <input style="background-color:#D0CFCF;color:black;width:500px;"
            type="text" name="nombre" value="<?php echo $nombre;?>" disabled />
        </p>
        <p>           
           <label><b>NIF</b></label>
            <input  style="background-color:#D0CFCF;color:black;width:120px;"
            type="text" name="nif" value="<?php echo $nif;?>" disabled />
        </p>

        <p>           
           <label><b>Dirección</b></label>
            <input style="width:500px;"
            type="text" name="direccion" value="<?php echo $direccion;?>"/>
        </p>

        <p>           
           <label><b>CP</b></label>
            <input style="width:100px;"
            type="text" name="cp" value="<?php echo $cp;?>"/>
                  
           <label><b>&nbsp;Municipio</b></label>
            <input style="width:293px;"
            type="text" name="municipio" value="<?php echo $municipio;?>"/>
        </p>

        <p>           
           <label><b>Provincia</b></label>
            <input style="width:250px;"
            type="text" name="provincia" value="<?php echo $provincia;?>"/>
        </p>
        <p>           
           <label><b>IBAN</b></label>
            <input style="background-color:#D0CFCF;color:black;width:250px;"
            type="text" name="iban" value="<?php echo $iban;?>"/>
            <input type=hidden name="clienteId" value="<?php echo $clienteId;?>"/>
        </p>
        
        <p>           
           <label><b>Teléfono</b></label>
            <input style="width:100px;"
            type="text" name="telefono" value="<?php echo $telefono;?>"/>
                  
           <label><b>&nbsp;Email</b></label>
            <input style="width:293px;"
            type="text" name="email" value="<?php echo $email;?>"/>
        </p>        
        <p style="text-align:center">        
            <input style="width:150px;font-weight:bold;" type="submit" value="Guardar cambios" />
        </p>
            <div id="retorno"></div>
        </form>
        <br/><br/><br/><br/>

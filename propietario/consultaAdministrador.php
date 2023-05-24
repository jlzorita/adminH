<?php
require("../config.php");
include("gets.php");
?>

<style>

textarea.mensaje{
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 8px;    
    height: 120px;
    width: 500px;
    padding: 12px 10px;
    resize: none;
}

</style>
<script>
    document.getElementById("datosPersonales").style.background = "";
    document.getElementById("publicacionesTablon").style.background = "";
    document.getElementById("recibosPendientes").style.background = "";
    document.getElementById("estadoContable").style.background = "";
    document.getElementById("consultaAdministrador").style.background = "#FFDD97";
    document.getElementById("autorizarFacturas").style.background = "";
</script>

<h2><b>Nueva consulta</b></h2>
        
<form onsubmit="enviarConsulta(); return false" id="form1">
<p>           
    <label><b>Título</b></label>
    <input type="text" name="titulo" />
</p>
<p>
    <label><b>Mensaje</b></label>
    <textarea style="vertical-align:top" class="mensaje" name="mensaje"></textarea>
</p>        
<p style="text-align:right">
    <input style="width:130px" type="submit" value="Enviar mensaje" />
    &nbsp;&nbsp;
</p> 
<div id="retorno"></div>           


<div id="pendiente">

<?php 
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
                padding:0px 10px;font-weight:bold;border-bottom:1px black solid;" > 
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

?>
</div>
</form>

<h2><b>Consultas resueltas</b></h2>

<?php
$mensajes = mensajesContestados();


if(!$mensajes != null){
    echo "No hay mensajes";
}else{
    foreach($mensajes as $mensaje){
    ?>
    <table style="width:600px;border-collapse: collapse;">
        <tr>
            <td style="border:1px black solid;width:120px;text-align:center;background-color:#FFBD35" rowspan="3"> 
                <b>Consulta</b>
            </td>
            <td style="padding:5px 5px;border:1px black solid;font-weight:bold;" > 
                <?php echo $mensaje["titulo"]; ?>
            </td>
        </tr>
        <tr>                
            <td style="padding:5px 5px;border-right:1px black solid" > 
                <?php echo $mensaje["mensaje"]; ?>
            </td>
        </tr>
        <tr>                
            <td style="font-size:10pt;border-right:1px black solid;text-align:right;
            padding:0px 10px;font-weight:bold;border-bottom:1px black solid;" > 
                <?php 
                    echo substr($mensaje["fechaM"],8,2);
                    echo "/";
                    echo substr($mensaje["fechaM"],5,2);
                    echo "/";
                    echo substr($mensaje["fechaM"],0,4);
                    echo " ";
                    echo substr($mensaje["fechaM"],11,5);
                    echo "h ";
                        echo $_SESSION["usuario"];
                ?>
            </td>
        </tr>

        <tr>
            <td style="border:1px black solid;width:120px;text-align:center;background-color:#BDBDBD" rowspan="2"> 
                <b>Respuesta</b>
            </td>                                   
            <td style="padding:5px 5px;border-right:1px black solid" > 
                <?php echo $mensaje["respuesta"]; ?>
            </td>
        </tr>
        <tr>                
            <td style="font-size:10pt;border-right:1px black solid;text-align:right;
            padding:0px 10px;font-weight:bold;border-bottom:1px black solid;" > 
                <?php 
                    echo substr($mensaje["fechaR"],8,2);
                    echo "/";
                    echo substr($mensaje["fechaR"],5,2);
                    echo "/";
                    echo substr($mensaje["fechaR"],0,4);
                    echo " ";
                    echo substr($mensaje["fechaM"],11,5);
                    echo "h ";
                    echo $mensaje["administrador"];
                ?>
            </td>
        </tr>


    </table>
    <br/>
<?php
    }
}
?>
<br/><br/><br/><br/>
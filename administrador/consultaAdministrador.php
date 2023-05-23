<?php
include("../config.php");
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
    document.getElementById("publicacionesTablon").style.background = "";
    document.getElementById("estadoContable").style.background = "";
    document.getElementById("generacionCuotas").style.background = "";
    document.getElementById("consultaAdministrador").style.background = "#FFDD97";
</script>
     
<?php 
$mensajes = mensajesNoContestadosComunidad();

if($mensajes == null){  
    echo "<b>No hay mensajes pendientes de contestar</b>";
}else{
    echo "<h2><b>Consultas pendientes de respuesta</b></h2>";
    foreach($mensajes as $mensaje){
        ?>
        
            <div id="div<?php echo $mensaje["id"]; ?>">
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
                    padding:0px 10px;font-weight:bold" > 
                        <?php 
                            echo substr($mensaje["fechaM"],8,2);
                            echo "/";
                            echo substr($mensaje["fechaM"],5,2);
                            echo "/";
                            echo substr($mensaje["fechaM"],0,4);
                            echo " ";
                            echo substr($mensaje["fechaM"],11,5);
                            echo "h </br>";
                            echo $mensaje["cliente"]["nombre"];
                        ?>
                    </td>
                </tr>


                <tr>
                    <td style="border:1px black solid;width:120px;text-align:center;background-color:#BDBDBD"> 
                        <b>Respuesta</b>
                    </td>
                    <td style="padding:0px 0px;border:1px black solid;font-weight:bold;border:white 0px solid;" > 
                        <form onsubmit="enviarRespuesta(<?php echo $mensaje['id']; ?>); return false" id="form<?php echo $mensaje['id'];?>">
                        <textarea style="width:468px;height:120px;resize:none" name="respuesta" id="respuesta<?php echo $mensaje['id'];?>">Respuesta ...</textarea>
                        <input type="hidden" name="clienteId" value="<?php echo $mensaje['cliente']['id']; ?>">
                    </td>                    
                </tr>                
            </table>
            <br/>
            <div style="text-align:right">
                <input type="button" onclick="enviarRespuesta(<?php echo $mensaje['id']; ?>);" value="Enviar respuesta" style="width:150px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </form>
            </div>
            <br/>
            </div>
        <?php
    }
}


?>
</div>

</form>


<br/><br/><br/><br/>
<?php
require("../config.php");
include("gets.php");
?>


<script>
    document.getElementById("datosPersonales").style.background = "";
    document.getElementById("publicacionesTablon").style.background = "";
    document.getElementById("recibosPendientes").style.background = "";
    document.getElementById("estadoContable").style.background = "";
    document.getElementById("consultaAdministrador").style.background = "";
    notificacionesEliminadas.eliminadas = 0;
</script>

<h2>Notificaciones</h2>

<table style="width:500px;border-collapse: collapse;border-spacing:5px;" id="myTable">


<tr style="background-color:#FFBD35">
    <td colspan="2" style="border:1px black solid;font-weight:bold;padding:0px 5px;">
    Mensaje<td style="border:1px black solid;">
</td>
</tr>

<?php
foreach(notificaciones() as $notificacion){
    ?>        
    <tbody id="tbody<?php echo $notificacion["id"];?>">
    
    <tr>
        <td style="border:1px black solid;padding:0px 5px;text-align:center;">
        <?php echo $notificacion["id"];?>            
        </td>            
        <td style="border:1px black solid;padding:0px 5px;">
        <div id="divMensaje<?php echo $notificacion["id"];?>">
        <?php echo $notificacion["mensaje"];?>            
        </div>
        </td>            
        
        <td style="color:#42734D;background-color:#6EC080;width:110px;
                    border:1px black solid;text-align:center;">

            <div id="div<?php echo $notificacion["id"];?>">
            <input type="hidden" name="id" value="<?php echo $notificacion["id"]; ?>" />
            <a href="javascript: eliminarNotificacion(<?php echo $notificacion["id"].", ".numNotificaciones(); ?>);">                
            eliminar</a>
            </div>  

            
        </td>                        
    </tr>        
    </tbody>
    <?php
}

?>

</table>

<br/><br/><br/><br/>
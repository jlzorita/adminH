<script>
    document.getElementById("datosPersonales").style.background = "";
    document.getElementById("publicacionesTablon").style.background = "#FFDD97";
    document.getElementById("estadoContable").style.background = "";
    document.getElementById("recibosPendientes").style.background = "";
    document.getElementById("consultaAdministrador").style.background = "";
    document.getElementById("autorizarFacturas").style.background = "";
</script>

<h2><b>Publicaciones tablón</b></h2>

<?php
require("../config.php");
include("gets.php");

$publicaciones = publicacionesComunidad();

foreach($publicaciones as $publicacion){
    ?>        
    <table style=" box-sizing: border-box;width: 600px;height: 294px;
    left: 388px;top: 158px;background: #FFFEE7;border: 1px solid #000000;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);cellpadding:0;";>
    
    <tr stlye="vertical-align:middle;">
        <td style="text-align:right;height:10px;
        vertical-align:bottom;font-size:12px;padding:0px 0px;font-weight:200;">
            <?php 
                echo substr($publicacion["fechaInicio"],8,2); 
                echo "/";
                echo substr($publicacion["fechaInicio"],5,2); 
                echo "/";
                echo substr($publicacion["fechaInicio"],0,4); 
                echo " a ";
                echo substr($publicacion["fechaFin"],8,2); 
                echo "/";
                echo substr($publicacion["fechaFin"],5,2); 
                echo "/";
                echo substr($publicacion["fechaFin"],0,4);                
                echo "&nbsp;&nbsp;&nbsp;";
            ?>
        </td>            
    </tr>
    <tr>
        <td style="text-align:center;height:25px;
        vertical-align:top;font-weight:bold;font-size:20px;">
            <?php echo $publicacion["titulo"]; ?>
        </td>            
    </tr>
    <tr>
        <td style="vertical-align:top;padding:10px;line-height: 1.5em;">
            <?php
                echo $publicacion["mensaje"];
            ?>
        </td>
    </tr>
    <tr stlye="vertical-align:middle;">
        <td style="text-align:right;height:10px;
        vertical-align:bottom;font-size:12px;padding:5px 5px;font-weight:200;">
            <?php 
                echo substr($publicacion["fechaEvento"],8,2);
                echo "/";
                echo substr($publicacion["fechaEvento"],5,2);
                echo "/";
                echo substr($publicacion["fechaEvento"],0,4);
                $enlace = "https://calendar.google.com/calendar/render?action=TEMPLATE&text=";
                $enlace = $enlace.str_replace(" ","+",$publicacion["titulo"]);
                $fecha = str_replace("-","",$publicacion["fechaEvento"]);
                $fecha = str_replace(":","",$fecha);
                $fecha = str_replace("+","",$fecha);
                $fecha = substr($fecha,0,8);                    
                $enlace = $enlace."&dates=".$fecha."/".$fecha;

            ?>
            <a href="<?php echo $enlace; ?>">
            <img style="width:30px;vertical-align:middle;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"
            src="../imagenes/google-calendar.png"/></a>
        </td>
    </tr>

    </table>
    
    <?php
    echo "<br/>";
}

?>
<br/><br/><br/><br/>
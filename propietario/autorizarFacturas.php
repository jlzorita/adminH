<?php
require("../config.php");
include("gets.php");
?>

<style>
table{    
    width:400px;
    border-collapse: collapse;
    border-spacing:5px;
}

td{
    border:1px black solid;
    padding: 0px 7px;
}

input[type=button]{
    gap: 10px;
    width: 265px;
    height: 60px;
    background: #6EC080;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 8px;
    text-align:center;
    vertical-align:center;
    font-weight:bold;
    font-size:17px;"
}
input[type=button]:hover{
    cursor: pointer;
}

</style>
<script>
    document.getElementById("datosPersonales").style.background = "";
    document.getElementById("publicacionesTablon").style.background = "";
    document.getElementById("recibosPendientes").style.background = "";
    document.getElementById("estadoContable").style.background = "";
    document.getElementById("consultaAdministrador").style.background = "";
    document.getElementById("autorizarFacturas").style.background = "#FFDD97";
</script>

<h2><b>Facturas pendientes de autorizar</b></h2>


<?php
$facturas = facturasPendientesAutorizar();

if($facturas == null){
    echo "<b>No hay facturas pendientes de autorizar.</b>";
}else{
    foreach($facturas as $factura){
        ?>
        <table>
        <tr>
            <td style="width:120px;"><b>Descripción</b></td>
            <td><?php echo $factura["descripcion"]; ?></td>
        </tr>
        <tr>
            <td><b>Proveedor</b></td>
            <td><?php echo nombreCliente($factura["proveedorId"]); ?></td>
        </tr>
        <tr>
            <td><b>Número de factura</b></td>
            <td><?php echo $factura["numeroFactura"]; ?></td>
        </tr>
        <tr>
            <td><b>Fecha factura</b></td>
            <td>
            <?php
            echo substr($factura["fechaFactura"],8,2); 
            echo "/";
            echo substr($factura["fechaFactura"],5,2); 
            echo "/";
            echo substr($factura["fechaFactura"],0,4);
            ?>    
            </td>
        </tr>
        <tr>
            <td><b>Partida</b></td>
            <td><?php echo partidaFactura($factura["id"]); ?></td>
        </tr>
        <tr>
            <td><b>Importe</b></td>
            <td style="text-align:center;font-weight:bold">
            <?php
            $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
            echo $fmt->formatCurrency($factura["importe"], "EUR");
            ?>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;">
            <?php
            if($factura["pdf"]){
                ?>
                    <a href="http://<?= $GLOBALS['exHost'];?>:<?= $GLOBALS['puertoCore'];?>/factura/ver/<?php echo $factura['id'];?>.pdf">
                    <img style="width:35px" src="../imagenes/pdf.png"/> 
                    </a>                    

                </td>
               <?php
            }        
                ?>
            </td>
    
            <td style="padding: 0px;">
                    <input type="button" id="boton<?php echo $factura["id"]; ?>"
                    onClick="autorizaFactura(<?php echo $factura["id"]; ?>);"
                    value="Autorizar">
            </td>
        </tr>
    </table>
    </br></br>
        <?php
        
    }
}

?>
<br/><br/><br/><br/>
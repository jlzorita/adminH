<h2><b>Detalle factura</b></h2>
<?php
require("../config.php");
include("gets.php");


$id = $_GET["id"];

$factura = getDetalleFactura($id);
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
    width: 165px;
    height: 40px;
    background: #FFBD35;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 8px;
    text-align:center;
    vertical-align:center;
    font-weight:bold;
    font-size:12px;"
}
input[type=button]:hover{
    cursor: pointer;
}

</style>


    <table>
    <tr>
        <td style="width:120px;"><b>Identificador</b></td>
        <td style="width:620px;"><?php echo $factura["id"]; ?></td>
    </tr>
    <tr>
        <td style="width:120px;"><b>Descripción</b></td>
        <td style="width:620px;"><?php echo $factura["descripcion"]; ?></td>
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
        <td style="text-align:center;" colspan="2">
        <?php
            if($factura["pdf"]){
                ?>
                    <a href="http://<?= $GLOBALS['exHost']; ?>:<?= $GLOBALS['puertoCore']; ?>/factura/ver/<?php echo $factura['id'];?>.pdf">
                    <img style="width:45px" src="../imagenes/pdf.png"/> 
                    </a>                    

                </td>
               <?php
            }else echo "No hay pdf disponible";
            ?>
        </td>
    </tr>
</table>
<br/><br/><br/><br/>
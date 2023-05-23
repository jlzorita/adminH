<?php
require("../config.php");
include("gets.php");
?>

<script>
    document.getElementById("datosPersonales").style.background = "";
    document.getElementById("publicacionesTablon").style.background = "";
    document.getElementById("recibosPendientes").style.background = "#FFDD97";
    document.getElementById("estadoContable").style.background = "";
    document.getElementById("consultaAdministrador").style.background = "";
    document.getElementById("autorizarFacturas").style.background = "";
</script>

<h2><b>Relación de recibos pendientes</b></h2>

<?php

$total = 0;
if(empty(recibosPendientes()))
    echo "No hay recibos pendientes";
else{
    ?>
    <table style="width:500px;border-collapse: collapse;border-spacing:5px;">
    <tr style="background-color:#FFBD35">
        <td style="border:1px black solid;text-align:center"><b>Recibo</b></td>
        <td style="border:1px black solid"><b>Concepto</b></td>
        <td style="border:1px black solid"><b>Fecha</b></td>
        <td style="border:1px black solid;text-align:right"><b>Importe</b></td>
    </tr>            
    <?php

    foreach(recibosPendientes() as $recibo){
    ?>
    
    <tr>
    <td style="border:1px black solid;text-align:center">
    <?php echo $recibo["id"];
    ?>
    </td>
    <td style="border:1px black solid">
    <?php echo $recibo["concepto"]; ?>
    </td>
    </td>
    <td style="border:1px black solid">
    <?php 
        echo substr($recibo["fechaRecibo"],8,2); 
        echo "/";
        echo substr($recibo["fechaRecibo"],5,2); 
        echo "/";
        echo substr($recibo["fechaRecibo"],0,4);
    ?>
    </td>
    <td style="border:1px black solid;text-align:right">
        <?php
            $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
            echo $fmt->formatCurrency($recibo["importe"], "EUR");
            $total = $total + $recibo["importe"];
        ?>
    </td>    
    </tr>
    <?php
    }

    ?>

    <tr>
    <td colspan="2"></td>
    <td style="border:1px black solid;background-color:#FFBD35"><b>Total</b></td>
    <td style="border:1px black solid;text-align:right;background-color:#FFBD35"><b>
    <?php
        $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
        echo $fmt->formatCurrency($total, "EUR");    
    ?></b></td>
    </tr>    

</table>
</br>

<p>Cuenta bancaria de la comunidad donde puede realizar ingresos. Recuerde indicar en el concepto su vivienda:</p>
<h2><?php 
$comunidad = datosComunidad();
echo $comunidad["iban"];
?></h2>

<?php
}
?>
    
<br/><br/><br/><br/>
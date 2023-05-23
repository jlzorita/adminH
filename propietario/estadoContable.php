<?php
require("../config.php");
include("gets.php");
?>

<script>
    document.getElementById("datosPersonales").style.background = "";
    document.getElementById("publicacionesTablon").style.background = "";
    document.getElementById("estadoContable").style.background = "#FFDD97";
    document.getElementById("recibosPendientes").style.background = "";
    document.getElementById("consultaAdministrador").style.background = "";
    document.getElementById("autorizarFacturas").style.background = "";
    document.getElementById("autorizarFacturas").style.background = "";
    
</script>

<h2><b>Estado contable</b></h2>

<?php
$presupuestos = presupuestosComunidad();

$saldoInicialTotal = 0;
foreach($presupuestos as $presupuesto){        
    $saldoInicialTotal = $saldoInicialTotal + $presupuesto["saldoInicial"];
    ?>
    <table style="width:600px;border-collapse: collapse;">
        <tr>
            <td colspan="1">
                Presupuesto
            </td>
            <td colspan="3" style="text-align:center;border:1px black solid;">
                <b><?php echo $presupuesto["nombre"]; ?></b>
            </td>
        <tr>
            <td >
                Vigencia
            </td>                        
            <td style="text-align:center;border:1px black solid;width:250px;">
                <b><?php
                    
                    echo substr($presupuesto["fechaInicial"],8,2); 
                    echo "/";
                    echo substr($presupuesto["fechaInicial"],5,2); 
                    echo "/";
                    echo substr($presupuesto["fechaInicial"],0,4); 
                    echo " a ";
                    echo substr($presupuesto["fechaFinal"],8,2); 
                    echo "/";
                    echo substr($presupuesto["fechaFinal"],5,2); 
                    echo "/";
                    echo substr($presupuesto["fechaFinal"],0,4);
                ?></b>
            </td>
            <td style="width:150px;text-align:center;">
                Saldo inicial
            </td>
            <td style="text-align:right;border:1px black solid">
                <b><?php 
                    $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
                    echo $fmt->formatCurrency($presupuesto["saldoInicial"], "EUR");
                    ?></b>
            </td>
        </tr>
    </table>
    <?php
}
?>
    <br/>
    <table style="width:600px">
        <tr>
            <td>
                <b>Total saldo inicial Comunidad</b>
            <td style="text-align:right;border:2px black solid;
                        font-weight:bold;background-color:#FFBD35;width:100px;">
                <?php
                    $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
                    echo $fmt->formatCurrency($saldoInicialTotal, "EUR");
                ?>
            </td>
        </tr>
    </table>

    <h3>Relación de facturas pagadas</h3>
    
<?php
$gastosTotal = 0;
foreach($presupuestos as $presupuesto){        
    $totalPresupuesto = 0;        
    ?>        
    <table style="width:600px;border-collapse: collapse;border-spacing:5px;">
    <th colspan="3" style="border:1px black solid;background-color:#FFBD35">
    Gastos <?php echo $presupuesto["nombre"]; ?>            
    </th>
    <?php
    $partidas = partidasPresupuesto($presupuesto["id"]);
    foreach($partidas as $partida){
        ?>
        <tr style="padding:3px;background-color:#FFEABE">
            <td colspan="3" style="border:1px black solid">
            <b><?php echo $partida["nombre"]; ?></b>
            </td>
        </tr>
        <?php
        $facturas = facturasPagadasPartida($partida["id"]);

        $totalPartida = 0;
        if($facturas != null){
            ?>
                <tr>
                <td style="border:1px black solid"><b>Fecha pago</b></td>
                <td style="border:1px black solid"><b>Descripción</b></td>
                <td style="border:1px black solid;text-align:right;"><b>Importe</b></td>
                </tr>
            <?php
            
            
            foreach($facturas as $factura){
                if($factura["pagada"]){

                ?>
                    <tr>
                        <td style="border:1px black solid">
                            <?php 
                                echo substr($factura["fechaPago"],8,2); 
                                echo "/";
                                echo substr($factura["fechaPago"],5,2); 
                                echo "/";
                                echo substr($factura["fechaPago"],0,4);
                            ?>
                        </td>
                        <td style="border:1px black solid">
                            <a style="color:#C79101" href="javascript:detalleFactura(<?php echo $factura['id']?>);">
                            <?php echo $factura["descripcion"]; ?>
                            </a>
                        </td>
                        <td style="border:1px black solid;text-align:right">
                            <?php
                            $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
                            echo $fmt->formatCurrency($factura["importe"], "EUR");
                            $totalPartida = $totalPartida + $factura["importe"];
                            ?>
                        </td>
                </tr>
                <?php
                }
            }
        }    
        ?>
        <tr>
            <td style="border:1px black solid"></td>
            <td style="border:1px black solid"><b>Total partida</b></td>
            <td style="border:1px black solid;text-align:right"><b><?php
            $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
            echo $fmt->formatCurrency($totalPartida, "EUR");
            ?></b></td>
        </tr>
        <?php        
        $totalPresupuesto = $totalPresupuesto + $totalPartida;
    }
    ?>
    <tr>
    <td style="border:1px black solid"></td>
    <td style="border:1px black solid;background-color:#FFBD35"><b>Total gastos presupuesto</b></td>
    <td style="border:1px black solid;text-align:right;background-color:#FFBD35"><b><?php
    $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
    echo $fmt->formatCurrency($totalPresupuesto, "EUR");
    ?></b></td>
</tr>    

    </table>
    <?php
    $gastosTotal = $gastosTotal + $totalPresupuesto;
    }
?>
</br>
<table style="width:600px;border-collapse: collapse;border-spacing:5px;">
    <tr>
        <td>
            <b>Total gastos</b>
        <td style="text-align:right;border:2px black solid;
                    font-weight:bold;background-color:#FFBD35;width:100px;">
            <?php
                $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
                echo $fmt->formatCurrency($gastosTotal, "EUR");
            ?>
        </td>
</tr>
</table>
</br>
<table style="width:600px;border-collapse: collapse;border-spacing:5px;">
    <tr>
        <td>
            <b>Total ingresos</b>
        <td style="text-align:right;border:2px black solid;
                    font-weight:bold;background-color:#FFBD35;width:100px;">
            <?php
                $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
                echo $fmt->formatCurrency(totalIngresosComunidad("2023"), "EUR");
            ?>
        </td>
</tr>
</table>
</br>
<table style="width:600px;border-collapse: collapse;border-spacing:5px;">
    <tr>
        <td>
            <b>Saldo total</b>
        <td style="text-align:right;border:2px black solid;
                    font-weight:bold;background-color:#FFBD35;width:100px;">
            <?php
                $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
                echo $fmt->formatCurrency($saldoInicialTotal-$gastosTotal+totalIngresosComunidad("2023"), "EUR");
            ?>
        </td>
</tr>
</table>

<h3>Facturas pendientes de pago</h3>
              
<table style="width:600px;border-collapse: collapse;border-spacing:5px;">
<tr>
<td style="border:1px black solid"><b>Proveedor</b></td>
<td style="border:1px black solid"><b>Fecha factura</b></td>
<td style="border:1px black solid"><b>Descripción</b></td>
<td style="border:1px black solid;text-align:right;"><b>Importe</b></td>
</tr>
<?php
    $facturasPendientes = facturasPendientes();            
                
    foreach($facturasPendientes as $facturaPendiente){
        ?>
        <tr>
            <td style="border:1px black solid">
            <?php echo nombreCliente($facturaPendiente["proveedorId"]); ?>
            </td>
            <td style="border:1px black solid">
            <?php
                echo substr($facturaPendiente["fechaFactura"],8,2); 
                echo "/";
                echo substr($facturaPendiente["fechaFactura"],5,2); 
                echo "/";
                echo substr($facturaPendiente["fechaFactura"],0,4); 
            ?>
            </td>
            <td style="border:1px black solid">
                <a style="color:#C79101" href="javascript:detalleFactura(<?php echo $facturaPendiente['id']?>);">
                <?php echo $facturaPendiente["descripcion"];?>
                </a>
            </td>
            <td style="border:1px black solid;text-align:right;">
            <?php
            $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
            echo $fmt->formatCurrency($facturaPendiente["importe"], "EUR");
            ?>
            </td>
        </tr>

        <?php
    }

?>
</table>
<br/><br/><br/><br/>




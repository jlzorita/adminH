<?php
require("../config.php");
include("gets.php"); 
?>

<script>
    document.getElementById("publicacionesTablon").style.background = "";
    document.getElementById("estadoContable").style.background = "";
    document.getElementById("generacionCuotas").style.background = "#FFDD97";
    document.getElementById("consultaAdministrador").style.background = "";
</script>
    

<h2><b>Generación recibos</b></h2>

<form onsubmit="crearRecibos(); return false" id="form1">
<p>
    <label><b>Concepto</b></label>
    <input type="text" name="concepto" style="height:16px;width:330px">
</p>

<p>
    <label><b>Fecha recibo</b></label>
    <input type="date" name="fechaRecibo"  style="height:16px">
</p>
<p>
    <label><b>Forma de pago</b></label>
    <select name="coeficiente" id="coeficiente" style="width:155px">
        <option value="0">Partes iguales</option>
        <option value="1">Coeficiente</option>
    </select>
</p>
<p>
    <label><b>Importe total</b></label>    
    <input type="number" id="importe" name="importe" style="height:16px;width:134px;text-align:right;" step="any">
    <input style="width:100px;" onClick="reparto(<?php echo numEntidadesComunidad(); ?>)" type="button" value="Repartir"/>
    <input style="width:90px;" type="reset" value="Reset"/>
</p>


<h2><b>Importes por entidad</b></h2>

<?php

foreach(getEntidadesComunidad() as $entidad){
    ?>
        <p>
        <label><b><?php echo $entidad["nombre"];?></b></label>
        <input type="text" name="coef<?php echo $entidad["id"];?>" id="coef<?php echo $entidad["id"];?>" 
            style="height:16px;width:80px;text-align:right;background-color:#FFDD97"
            value="<?php echo $entidad["coeficiente"];?>" disabled>
        <input type="number" name="importe<?php echo $entidad["id"];?>" id="importe<?php echo $entidad["id"];?>"
        style="height:16px;width:134px;text-align:right;" step="any">
        
        </p>
    <?php
}
?>
    <p>
    <label></label>
    <input style="width:154px;" type="submit" value="Generar recibos"/>
    
    </p>
    
</form>
<div id="retorno"></div>

<br/><br/><br/><br/>
<?php
require("../config.php");
include("gets.php");

$presupuestoId = $_POST["presupuesto"];    

?>

<h2><b>Generación de nueva factura</b></h2>

<form onsubmit="generarFactura(); return false" id="form1">
<p>
    <label><b>Partida</b></label>
    <select name="partida">
    <?php 
        foreach(partidasPresupuesto($presupuestoId) as $partida){
            ?>
            <option value="<?php echo $partida["id"]; ?>">
                <?php echo $partida["nombre"]; ?>
            </option>
            <?php
        }
    ?>
    </select>
</p>
<p>
    <label><b>Proveedor</b></label>
    <select name="proveedor">
    <?php 
        foreach(getProveedores() as $proveedor){
            ?>
            <option value="<?php echo $proveedor["id"]; ?>">
                <?php echo $proveedor["nombre"]; ?>
            </option>
            <?php
        }
    ?>
    </select>
</p>
<p>
    <label><b>Fecha factura</b></label>
    <input type="date" name="fechaFactura">
    <input type="hidden" name="presupuesto" value="<?php echo $presupuestoId?>">
    <label><b>Nº factura</b></label>
    <input type="text" name="numFactura" style="height:16px;width:137px;">
</p>
<p>
    <label><b>Descripción</b></label>    
    <input type="text" name="descripcion" style="height:16px;width:400px;">
</p>
<p>
    <label><b>Importe</b></label>    
    <input type="number" name="importe" style="height:16px;width:130px;text-align:right;" step="any">
</p>
<label></label>
<input type="submit" value="Generar factura" style="width:150px">

</form>
</p>

<div id="retorno"></div>
</br></br></br></br>
<?php
require_once("../config.php");
include("gets.php");

if (isset($_GET['logout'])) {
	session_destroy();
	logout();
	header("Location: ../index.php");
}


?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/ico" href="../imagenes/adminh.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script type="text/javaScript" src="codi.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="tinymce.min.js" referrerpolicy="origin"></script>	

<link href="../estilos.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css' />
<script>tablonAnuncios();</script>


</head>
	<body>
	<?php
	if(isset($_GET["publicar"])){
		if($_GET["publicar"] == "true"){				
			?>
			<script>
				nuevaPublicacion();
			</script>
			<?php
		}
	}
	?>
		<div style="position:absolute;top:0px;left:50%;bottom:0px;">					
			<div class="exterior">
				<div class="superior">
					<div style="position:relative;width:400px;height: 80px;float:left;left:73px;">
								<div class="ContenidoCentradoV" style="text-align:left">
									<img style="height:70px" src="../imagenes/logo1.png" alt="ADMINH" />
								</div>
					</div>
										
					<div style="width:60px;position:relative;height:80px;text-align:right;							
								position:relative;left:0px;font-weight:bold;float: left;">
								<div class="ContenidoCentradoV" style="text-align:right">						
									<img style="height:35px" src="../imagenes/edificio-de-oficinas.png" alt="EDIF" />
									&nbsp;
								</div>
					</div>
					<div style="width:140px;position:relative;height:80px;text-align:right;
								position:relative;left:0px;font-weight:bold;float: left;">
								<div class="ContenidoCentradoV" style="text-align:left">
								<form id="formCom">
								<select onChange="cambiaComunidad();" name="comunidad" style="width:200px;">
								<?php									
								foreach(comunidadesAdministrador() as $comunidad){
									?>
									<option name="<?php echo $comunidad['id'];?>" value="<?php echo $comunidad['id'];?>"
									<?php if($_SESSION["comunidadId"] == $comunidad['id']) echo " selected"; ?>
									>
									<?php echo $comunidad['nombre'];?>
									</option>

								<?php
								}
								?>
								<?php echo datosComunidad()["nombre"];?></br>
								</select></form>
								</div>
								
					</div>

					<div style="width:100px;position:relative;height:80px;text-align:right;
								position:relative;left:0px;font-weight:bold;float: left;">
								<div class="ContenidoCentradoV" style="text-align:right">						
								<img style="height:26px" src="../imagenes/profile-user.png" alt="USER" />									
								&nbsp;
								</div>
					</div>
					<div style="width:150px;position:relative;height:80px;text-align:left;
								position:relative;left:0px;float: left;">
								<div class="ContenidoCentradoV" style="text-align:left">						
								Usuario conectado:<br/>
								<b><?php echo $_SESSION["usuario"]; ?></b> [<a href="index.php?logout=true">logout</a>]
								
								</div>
					</div>
				</div>
			
				<br/><br/>
				<div class="menuIzq">
					<br/>
					<br/>
					<div id="publicacionesTablon" class="OpcionMenuIzq">
					<a href=" javascript: tablonAnuncios();"><div class="ContenidoCentradoV">&nbsp;&nbsp;
						<img src="../imagenes/newspaper.png" style="width:25px;vertical-align:middle;">
						&nbsp;Tablón de anuncios</div></a>
					</div>
					<div id="estadoContable" class="OpcionMenuIzq">
					<a href=" javascript: estadoContable();"><div class="ContenidoCentradoV">&nbsp;&nbsp;
						<img src="../imagenes/accounting.png" style="width:25px;vertical-align:middle;">
						&nbsp;Estado contable</div></a>
					</div>
					<div id="generacionCuotas" class="OpcionMenuIzq">
					<a href=" javascript: generarCuotas();"><div class="ContenidoCentradoV">&nbsp;&nbsp;
						<img src="../imagenes/moneda-de-dinero.png" style="width:25px;vertical-align:middle;">
						&nbsp;Generación cuota</div></a>
					</div>
					<div id="consultaAdministrador" class="OpcionMenuIzq">
					<a href=" javascript: consultaAdministrador();"><div class="ContenidoCentradoV">&nbsp;&nbsp;
						<img src="../imagenes/chat.png" style="width:25px;vertical-align:middle;">
						&nbsp;Consulta administrador</div></a>
					</div>

					<?php

					if($_SESSION["nivel"] == 1){
						?>						
						<div id="autorizarFacturas" class="OpcionMenuIzq">
						<a href=" javascript: autorizarFacturas();"><div class="ContenidoCentradoV">&nbsp;&nbsp;
							<img src="../imagenes/safe.png" style="width:25px;vertical-align:middle;">
							&nbsp;Autorizar facturas</div></a>
						</div>

					<?php
					}
					?>
					<br/><br/>
				</div>

				<div id="contenido" class="contenido"></div>

				<div  style="position:absolute;bottom:0px;left: 100px;width: 700px;height:50px;z-index: 0;background-color: #FFBD35;
							border-top-left-radius: 10px;border-top-right-radius: 10px;">
				<div class="ContenidoCentradoV" style="text-align:center;bottom:10px;">
											<b>José Luis Zorita - TFG Java EE - 2º semestre 2022/2023</b></div>
				</div>
			</div>
		</div>
	</body>
</html>
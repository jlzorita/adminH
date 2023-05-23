<?php
require("../config.php");
include("gets.php");

if (isset($_GET['logout'])) {
	session_destroy();
	logout();
	header("Location: ../index.php");
}

?>

<html>
	<head>
	<link rel="shortcut icon" type="image/ico" href="../imagenes/adminh.ico"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script type="text/javaScript" src="codi.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<link href="../estilos.css" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css' />
	<!-- Por defecto se muestra el estado de cuentas -->
	<script>estadoContable();</script>


</head>
	<body>
		<div style="position:absolute;top:0px;left:50%;bottom:0px;">
			<div class="exterior">
				<div class="superior">
					<div style="position:relative;width:150px;height: 80px;float:left;">
								<div class="ContenidoCentradoV" style="text-align:right">
									<img style="height:70px" src="../imagenes/logo1.png" alt="ADMINH" />
								</div>
					</div>
										
					<div id="notificaciones" style="width:250px;position:relative;height:80px;text-align:right;							
								position:relative;left:0px;font-weight:bold;float: left;">
								<div id="mostrarNumNotificaciones" class="ContenidoCentradoV" style="text-align:center">						

								<?php
									if(numNotificaciones() > 0){
										echo "<a href=\" javascript: verNotificaciones();\">";
										echo "<img style=\"width:25px;vertical-align:middle;\"src=\"../imagenes/notification.png\">";										
										echo "Tienes notificaciones";
										echo "</a>";
									}
								?>
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
									<?php echo datosComunidad()["nombre"];?></br>
									Entidad: <?php echo entidadesCliente()[$_SESSION["entidadCom"]]["entidad"]["nombre"]; ?>
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
					<div id="datosPersonales" class="OpcionMenuIzq">
						<a href=" javascript: datosPersonales();"><div class="ContenidoCentradoV" >&nbsp;&nbsp;
							<img src="../imagenes/profile-user.png" style="width:25px;vertical-align:middle;">
							&nbsp;Datos personales</div></a>
					</div>
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
					<div id="recibosPendientes" class="OpcionMenuIzq">
					<a href=" javascript: recibosPendientes();"><div class="ContenidoCentradoV">&nbsp;&nbsp;
						<img src="../imagenes/moneda-de-dinero.png" style="width:25px;vertical-align:middle;">
						&nbsp;Recibos pendientes</div></a>
					</div>
					<div id="consultaAdministrador" class="OpcionMenuIzq">
					<a href=" javascript: consultaAdministrador();"><div class="ContenidoCentradoV">&nbsp;&nbsp;
						<img src="../imagenes/chat.png" style="width:25px;vertical-align:middle;">
						&nbsp;Consulta administrador</div></a>
					</div>
					<div class="OpcionMenuIzq">
						<div class="ContenidoCentradoV">&nbsp;&nbsp;
						<img src="../imagenes/credit-cards.png" style="width:25px;vertical-align:middle;">
						&nbsp;Forma de pago</div>
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
					<br/>
					<br/>

				</div>


				<div id="contenido" class="contenido"></div>


				<div  style="position:absolute;bottom:0px;left: 100px;width: 700px;height:50px;z-index: 0;background-color: #FFBD35;
								border-top-left-radius: 10px;border-top-right-radius: 10px;
				">
				<div class="ContenidoCentradoV" style="text-align:center;bottom:10px;">
											<b>José Luis Zorita - TFG Java EE - 2º semestre 2022/2023</b></div>
				</div>
			</div>
		</div>
	</body>
</html>
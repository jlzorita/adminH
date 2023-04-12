<html>

<head>
<title>ADMINH</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script type="text/javaScript" src="js/functions.js"></script>

</head>
<body>
<h3>AdminH</h3>
<form onsubmit="comprobarDatos(); return false" id="form1">
Usuario
<input type="text" name="usuario"><br />
Contraseña
<input type="password" name="password"><br />
<input type="submit" value="Acceder" />
<div id="retorno"></div>
</form>
</body>
</html>
function comprobarDatos(){	

	$.ajax({
	type: 'POST',
	url: 'process.php',
	data: $('#form1').serialize(),

	success: function(respuesta) {        
		if(respuesta == "noN"){            
            document.getElementById("retorno").innerHTML = "Introduce un nombre.";           
        }else if(respuesta == "noP"){
            document.getElementById("retorno").innerHTML = "Introduce una contraseña.";
        }else if (respuesta.includes("401")){
            document.getElementById("retorno").innerHTML = "Usuario o contraseña incorrectos.";
        }else{
            location.href = 'principal.php';            
        }
	}
	});
}
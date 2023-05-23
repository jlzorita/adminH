function datosPersonales(){
    $.ajax({
    url: 'datosPersonales.php',    
    success: function(result) {
        $('#contenido').html(result);
    }
});  
}

function tablonAnuncios(){    
    $.ajax({
    url: 'tablonAnuncios.php',    
    success: function(result) {
        $('#contenido').html(result);
    }
});  
}

function consultaAdministrador(){    
    $.ajax({
    url: 'consultaAdministrador.php',
    success: function(result) {
        $('#contenido').html(result);
    }
});  
}

function recibosPendientes(){
    $.ajax({
    url: 'recibosPendientes.php',    
    success: function(result) {
        $('#contenido').html(result);
    }
});  
}

function estadoContable(){    
    $.ajax({
    url: 'estadoContable.php',    
    success: function(result) {
        $('#contenido').html(result);
    }
});  
}

function verNotificaciones(){    
    $.ajax({
    url: 'notificaciones.php',
    success: function(result) {
        $('#contenido').html(result);
    }
});  
}

function autorizarFacturas(id){    
    $.ajax({
    url: 'autorizarFacturas.php',    
    success: function(result) {
        $('#contenido').html(result);
    }
});  
}

function detalleFactura(id){
    $.ajax({
    url: 'detalleFactura.php',    
    data: {"id": id},
    success: function(result) {
        $('#contenido').html(result);
    }
});  
}


function updateUsuario(){	
	$.ajax({
        type: 'POST',
        url: 'post/actualizarDatos.php',
        data: $('#form1').serialize(),

        success: function(respuesta) {

            document.getElementById("retorno").style.color = "red";
            document.getElementById("retorno").style.fontWeight = "bold";

            if(respuesta == "noDireccion"){
                document.getElementById("retorno").innerHTML = "<b>Debes introducir una dirección.</b>";
            }else if(respuesta == "noCp"){
                document.getElementById("retorno").innerHTML = "<b>Debes introducir un código postal.</b>";
            }else if(respuesta == "noMunicipio"){
                document.getElementById("retorno").innerHTML = "<b>Debes introducir un municipio.</b>";
            }else if(respuesta == "noProvincia"){
                document.getElementById("retorno").innerHTML = "<b>Debes introducir una provincia.</b>";
            }else if(respuesta == "401"){
                document.getElementById("retorno").innerHTML = "<b>Acceso no autorizado</b>";
            }else{            
                document.getElementById("retorno").style.color = "green";
                document.getElementById("retorno").innerHTML = "<b>Datos actualizados</b>";
            }
        }
        });
}

function enviarConsulta(){	        
	$.ajax({
        type: 'POST',
        url: 'post/enviarConsulta.php',
        data: $('#form1').serialize(),
        
        success: function(respuesta) {
            document.getElementById("retorno").style.color = "red";
            document.getElementById("retorno").style.fontWeight = "bold";

            if(respuesta == "500"){
                document.getElementById("retorno").innerHTML = "<b>No puedes enviar mensajes si hay pendientes de contestar.</b>";
            }else if(respuesta == "noTitulo"){
                document.getElementById("retorno").innerHTML = "<b>Debes introducir un título.</b>";
            }else if(respuesta == "noMensaje"){
                document.getElementById("retorno").innerHTML = "<b>Debes introducir un mensaje.</b>";            
            }else{                                
                document.getElementById("retorno").style.color = "green";
                document.getElementById("retorno").innerHTML = "<b>Mensaje enviado</b>";
                document.getElementById("pendiente").innerHTML = respuesta;                
            }
        }
        }); 
}


function autorizaFactura(id){    
	$.ajax({
        type: 'POST',
        url: 'post/autorizarFactura.php',
        data: {'id' : id},
        
        success: function(respuesta) {
            if(respuesta == "200"){
                document.getElementById("boton"+id).style.backgroundColor = "#EDA08E"; 
                document.querySelector('#boton'+id).value = 'Autorizada!';
            }
        }
        }); 
}

function eliminarNotificacion(id, numNotificaciones){	    
	$.ajax({
        type: 'POST',
        url: 'post/eliminarNotificacion.php',        
        data: {'id': id},
                        
        success: function(respuesta) {
            notificacionesEliminadas.eliminadas++;
            if(respuesta == "200"){
                document.getElementById("div"+id).innerHTML = "eliminado";
                document.getElementById("div"+id).style.backgroundColor = "#EDA08E";
                document.getElementById("divMensaje"+id).style.textDecoration = "line-through";

                if(numNotificaciones == notificacionesEliminadas.eliminadas){
                    document.getElementById("mostrarNumNotificaciones").innerHTML = "";
                    notificacionesEliminadas.eliminadas = 0;

                }
            }            
        }
        
        });
}

class notificacionesEliminadas{
    static eliminadas = 0;	
}


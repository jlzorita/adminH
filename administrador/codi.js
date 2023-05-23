function tablonAnuncios(){    
    $.ajax({
    url: 'tablonAnuncios.php',
    success: function(result) {
        $('#contenido').html(result);
    }
});  
}


function nuevaPublicacion(){
    $.ajax({
    url: 'nuevaPublicacion.php',
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


function reparto(entidades){
    total = document.getElementById("importe").value;
    coeficiente = document.getElementById("coeficiente").value;

    for(i=1;i<=entidades;i++){
        if(coeficiente == 0)
            document.getElementById("importe"+i).value = (total/entidades);
        if(coeficiente == 1)
            document.getElementById("importe"+i).value = document.getElementById("coef"+i).value /100 * total;
    }    
}

function nuevaFactura(){    
    $.ajax({
        type: 'POST',
        url: 'nuevaFactura.php',
        data: $('#form23').serialize(),
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

function generarCuotas(){
    $.ajax({
    url: 'generarCuotas.php',
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

function editorTexto(){   
    document.getElementById("editorTexto").style.display = "flex";
}

function crearPublicacion(){
    var content = tinyMCE.activeEditor.getContent();
	$.ajax({
        type: 'POST',
        url: 'post/crearPublicacion.php',
        data: $('#form1').serialize()+ '&content=' + content,
        
        
        success: function(respuesta) {            
            document.getElementById("retorno").style.color = "red";
            document.getElementById("retorno").style.fontWeight = "bold";
            if(respuesta == "1"){
                document.getElementById("retorno").innerHTML = "<b>La fecha de fin no puede ser inferior o igua a la fecha de inicio.</b>";
            }else if(respuesta == "2"){
                document.getElementById("retorno").innerHTML = "<b>La fecha de evento no puede ser inferior al rango de fechas.</b>";
            }else if(respuesta == "3"){
                document.getElementById("retorno").innerHTML = "<b>Debes introducir un título.</b>";                
            }else if(respuesta == "4"){
                document.getElementById("retorno").innerHTML = "<b>Debes introducir un mensaje.</b>";
            }else if(respuesta == "5"){
                document.getElementById("retorno").innerHTML = "<b>Debes introducir todas las fechas.</b>";            
            }else if(respuesta == "200"){
                document.getElementById("retorno").style.color = "green";
                document.getElementById("retorno").innerHTML = "<b>¡Publicación creada!</b>";
                location.href = "index.php";
            }
        }
        }); 
}

function eliminarPublicacion(id){
    
	$.ajax({
        type: 'POST',
        url: 'post/eliminarPublicacion.php',
        data: {"id" :id},      
    
        success: function(respuesta) {            
            document.getElementById("retorno")
            if(respuesta == "200"){
                document.getElementById("div"+id).style.display = "none";
            }
        }
        }); 
}

function generarFactura(){    
	$.ajax({
        type: 'POST',
        url: 'post/generarFactura.php',
        data: $('#form1').serialize(),
                        
        success: function(respuesta) {            
            document.getElementById("retorno").style.color = "red";
            document.getElementById("retorno").style.fontWeight = "bold";
            if(respuesta == "1"){
                document.getElementById("retorno").innerHTML = "<b>Debes elegir una fecha de factura.</b>";
            }else if(respuesta == "2"){
                document.getElementById("retorno").innerHTML = "<b>Debes indicar una descripción.</b>";
            }else if(respuesta == "3"){
                document.getElementById("retorno").innerHTML = "<b>Debes indicar un importe.</b>";        
            }else if(respuesta == "200"){
                document.getElementById("retorno").style.color = "green";
                document.getElementById("retorno").innerHTML = "<b>¡Factura creada!</b>";
                estadoContable();
            }
        }
        }); 
}

function cambiaComunidad(){
    $.ajax({
        type: 'POST',
        url: 'cambiarComunidad.php',
        data: $('#formCom').serialize(),
                
        success: function(respuesta) {
            location.href = "index.php";
        }
    });
}


function enviarRespuesta(id){    
	$.ajax({
        type: 'POST',
        url: 'post/enviarRespuesta.php',
        data: $('#form'+id).serialize()+ '&id=' + id,
        
        
        success: function(respuesta) {
            if(respuesta == "1"){
                document.getElementById("respuesta"+id).style.border = "2px red solid";                
            }else if(respuesta == "200"){
                document.getElementById("div"+id).style.display = "none";                
            }else{

            }
        }
        }); 
}

function subirFactura(){    
    var formData = new FormData(document.getElementById("formFile"));
	$.ajax({
        type: 'POST',
        url: 'post/subirFactura.php',
        data: formData,
        processData: false,
        contentType: false,

        success: function(respuesta) {            
            document.getElementById("verPdf").innerHTML = respuesta;
        }
        }); 
}

function crearRecibos(){        
	$.ajax({
        type: 'POST',
        url: 'post/crearRecibos.php',
        data: $('#form1').serialize(),
        
        success: function(respuesta) {
            document.getElementById("retorno").style.color = "red";
            document.getElementById("retorno").style.fontWeight = "bold";
            if(respuesta == "1"){
                document.getElementById("retorno").innerHTML = "<b>Debes introducir una fecha.</b>";
            }else if(respuesta == "2"){
                document.getElementById("retorno").innerHTML = "<b>Debes introducir un concepto.</b>";
            }else if(respuesta == "3"){
                document.getElementById("retorno").innerHTML = "<b>Todas las entidades deben tener un importe.</b>";            
            }else if(respuesta == "200"){
                document.getElementById("retorno").style.color = "green";
                document.getElementById("retorno").innerHTML = "<b>¡Recibos creados!</b>";
                document.getElementById("form1").reset();
            }
        }
        }); 
}
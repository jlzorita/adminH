<?php
require("../config.php");
include("gets.php");
?>
<script src="tinymce.min.js" referrerpolicy="origin"></script>
<h2><b>Introduce los datos de tu publicación</b></h2>

<div id="editorTexto">

<form onsubmit="crearPublicacion(); return false" id="form1">
<p>           
    <label><b>Título</b></label>
    <input type="text" name="titulo" style="height:16px;width:490px;"/>
</p>

<p>           
  <label><b>Mensaje</b></label>
  <textarea name="mensaje"></textarea>
 
  <script>  
     tinymce.init({
      entity_encoding : "raw",    //Tengo que añadir esta línea por problemas con los acentos
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });	
  </script>
  
</p>
<p>
<label><b>Fecha inicio</b></label>
<input type="date" name="fechaInicio">
<label>&nbsp;&nbsp;&nbsp;<b>Fecha fin</b></label>
<input type="date" name="fechaFin">
</p>

<p>
<label><b>Fecha evento</b></label>
<input type="date" name="fechaEvento">
</p>
<p>
<label></label>
<input style="width:154px;" type="submit" value="Crear publicación"/>
</p>
</form>

</div>
<div id="retorno"></div>
</br></br></br></br>
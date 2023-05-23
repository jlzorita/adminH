<?php
  require("../../config.php");
  include("../gets.php");

  $id = $_POST["id"];
  $file = $_FILES["file"];

  //echo "POST: $_POST";
  //echo "FILES: $_FILES",

  $dir = "facturas/";
  move_uploaded_file($_FILES["file"]["tmp_name"], $dir.$file["name"]);

  //Realizar POST subir fichero
  $url = "http://$GLOBALS[host]:$GLOBALS[puertoCore]/factura/subir";


    $post = array('file' => new CurlFile($dir.$file["name"], 'application/pdf', $id), 'id' => $id);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_POST,1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
    $result=curl_exec ($curl);
    
    echo $result;


    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    $ver = "<a href=\"http://$GLOBALS[exHost]:$GLOBALS[puertoCore]/factura/ver/$id.pdf\">";
    $ver = $ver."<img style=\"width:45px\" src=\"../imagenes/pdf.png\"/></a>";

    echo $ver;

    unlink($dir.$file["name"]);
  
          

?>
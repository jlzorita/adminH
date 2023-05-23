<?php    

if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$GLOBALS["host"] = "localhost";
$GLOBALS["exHost"] = "localhost";
$GLOBALS["puertoUser"] = "18081";
$GLOBALS["puertoCrm"] = "18082";
$GLOBALS["puertoCore"] = "18083";

?>
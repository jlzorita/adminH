<?php

    echo "SESION:";
    session_start();
    echo session_id();
    echo "<br />";
    echo $_SESSION['usuario'];

?>
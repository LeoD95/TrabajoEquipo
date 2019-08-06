<?php
    include('../sesiones/verificar_sesion.php');

    $id_persona = $_POST['idPersona'];

    $cadena = mysql_query("SELECT CONCAT(nombre,' ',ap_paterno,' ',ap_materno) FROM personas WHERE id_persona = '$id_persona'",$conexion);

    $row = mysql_fetch_array($cadena);
    echo $row[0];
?>
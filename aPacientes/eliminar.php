<?php
    include('../sesiones/verificar_sesion.php');

    $id_usuario =  $_SESSION["idUsuario"];

    $id_detalle = $_POST['id_detalle'];

    $cadena = mysql_query("UPDATE detalle_paciente SET activo = '0' WHERE id_detalle_paciente = '$id_detalle'",$conexion);
?>
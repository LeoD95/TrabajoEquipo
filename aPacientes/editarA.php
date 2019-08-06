<?php
    include('../sesiones/verificar_sesion.php');

    $id_detalle = $_POST['id_detalle'];

    $cadena = mysql_query("SELECT id_medicamento,comentario FROM detalle_paciente WHERE id_detalle_paciente = '$id_detalle'",$conexion);
    $row = mysql_fetch_array($cadena);
    $array=array($row[0],$row[1]);
    echo json_encode($array);
?>
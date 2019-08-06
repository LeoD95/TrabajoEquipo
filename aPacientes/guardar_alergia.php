<?php
    include('../sesiones/verificar_sesion.php');

    $id_usuario =  $_SESSION["idUsuario"];

    $medicamento = $_POST['medicamento'];
    $efectos     = $_POST['efectos'];
    $idPaciente  = $_POST['idPaciente'];
    $idDet       = $_POST['idDet'];

    if($idDet == 0){
        $verificar = mysql_query("SELECT id_detalle_paciente FROM detalle_paciente WHERE id_paciente = '$idPaciente' AND id_medicamento = '$medicamento' AND activo = '1'",$conexion);
        $existe = mysql_num_rows($verificar);
        if($existe == 0){
            $cadena = mysql_query("INSERT INTO detalle_paciente (id_paciente,id_medicamento,comentario,id_registro,fecha_registro,hora_registro,activo) VALUES ('$idPaciente','$medicamento','$efectos','$id_usuario','$fecha','$hora','1')",$conexion);
            echo "ok";
        }else{
            echo "duplicado";
        }
    }else{
        $cadena = mysql_query("UPDATE detalle_paciente SET id_medicamento = '$medicamento', comentario = '$efectos' WHERE id_detalle_paciente = '$idDet'",$conexion);
        echo "ok";
    }
?>
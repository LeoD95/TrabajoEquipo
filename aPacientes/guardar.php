<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$nombre_persona = $_POST["nombre_persona"];
$numero_seguro  = $_POST["numero_seguro"];
$tipo_sangre    = $_POST["tipo_sangre"];
$estatura       = $_POST["estatura"];
$peso           = $_POST["peso"];


mysql_query("SET NAMES utf8");
$verificar = mysql_query("SELECT id_persona FROM pacientes WHERE id_persona = '$nombre_persona'",$conexion)or die(mysql_error());
$existe = mysql_num_rows($verificar);
if($existe == 0){
    $insertar = mysql_query("INSERT INTO pacientes ( id_persona, numero_seguro, tipo_sangre, estatura, peso, id_registro, fecha_registro, hora_registro, activo)
 VALUES('$nombre_persona','$numero_seguro','$tipo_sangre','$estatura','$peso','$id_usuario','$fecha', '$hora','1')",$conexion)or die(mysql_error());
 echo "ok";
}else{
    echo "duplicado";
}
?>
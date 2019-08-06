<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario           = $_SESSION["idUsuario"];

$numero_seguro  = $_POST["numero_seguro"];
$tipo_sangre    = $_POST["tipo_sangre"];
$estatura       = $_POST["estatura"];
$peso           = $_POST["peso"];
$ide            = $_POST["ide"];

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE pacientes SET
 							numero_seguro = '$numero_seguro',
 							tipo_sangre = '$tipo_sangre',
 							estatura = '$estatura',
 							peso = '$peso',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='$id_usuario'
						WHERE id_paciente='$ide'
							 ",$conexion)or die(mysql_error());

?>
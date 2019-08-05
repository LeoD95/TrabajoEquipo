<?php
//se manda llamar la conexion
include("../conexion/conexion.php");

$idPaciente    = $_POST["idPaciente"];
$idDoctor   = $_POST["idDoctor"];
$descripcion   = $_POST["descripcion"];
$idMedicamento = $_POST["idMedicamento"];
$cantidad  = $_POST["cantidad"];
$numbers = rand(9999999, 9999999999);
shuffle($numbers);

$idPaciente    =trim($idPaciente);
$idDoctor   =trim($idDoctor);
$descripcion   =trim($descripcion);
$idMedicamento =trim($idMedicamento);
$cantidad  =trim($cantidad);
$numbers   =trim($numbers);
 
$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("INSERT INTO recetas 
 								(
 								id_paciente,
 								id_doctor,
 								descripcion,
 								id_medicamento,
 								cantidad,
 								codigo_receta,
 								id_registro,
 								fecha_registro,
 								hora_registro,
 								activo
 								)
							VALUES
								(
 								'$idPaciente',
 								'$idDoctor',
 								'$descripcion',
 								'$idMedicamento',
 								'$cantidad',
 								'$numbers',
 								'1',
 								'$fecha',
 								'$hora',
 								'1'
								)
							",$conexion)or die(mysql_error());

?>
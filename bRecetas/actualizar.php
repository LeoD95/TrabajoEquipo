<?php
//se manda llamar la conexion
include("../conexion/conexion.php");

$idPaciente    = $_POST["idPaciente"];
$idDoctor   = $_POST["idDoctor"];
$descripcion   = $_POST["descripcion"];
$idMedicamento = $_POST["idMedicamento"];
$cantidad  = $_POST["cantidad"];
$idReceta       = $_POST["idE"];

$idPaciente    =trim($idPaciente);
$idDoctor   =trim($idDoctor);
$descripcion   =trim($descripcion);
$idMedicamento =trim($idMedicamento);
$cantidad  =trim($cantidad);

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE recetas SET
							id_paciente='$idPaciente',
							id_doctor='$idDoctor',
							descripcion='$descripcion',
							id_medicamento='$idMedicamento',
							cantidad='$cantidad',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='1'
						WHERE id_receta='$idReceta'
							 ",$conexion)or die(mysql_error());

?> 
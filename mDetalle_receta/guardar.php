<?php
//se manda llamar la conexion
include("../conexion/conexion.php");
$codigo = $_POST["codigo"];
$idMedicamento = $_POST["idMedicamento"];
$cantidad  = $_POST["cantidad"];

$codigo   =trim($codigo);
$idMedicamento =trim($idMedicamento);
$cantidad  =trim($cantidad);

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
$insertar = mysql_query("INSERT INTO detalle_receta 
	(
	id_receta,
	id_medicamento,
	cantidad,
	id_registro,
	fecha_registro,
	hora_registro,
	activo
	)
	VALUES
	(
	'$codigo',
	'$idMedicamento',
	'$cantidad',
	'1',
	'$fecha',
	'$hora',
	'1'
	)
	",$conexion)or die(mysql_error());

	?>
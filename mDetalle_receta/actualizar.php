<?php
//se manda llamar la conexion
include("../conexion/conexion.php");


$idReceta       = $_POST["idReceta"];
$idMedicamento = $_POST["idMedicamento"];
$cantidad  = $_POST["cantidad"];
$idDetalle       = $_POST["idE"];

$idReceta   =trim($idReceta);
$idMedicamento =trim($idMedicamento);
$cantidad  =trim($cantidad);



$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
$insertar = mysql_query("UPDATE detalle_receta SET
	id_receta='$idReceta',
	id_medicamento='$idMedicamento',
	cantidad='$cantidad',
	fecha_registro='$fecha',
	hora_registro='$hora',
	id_registro='1'
	WHERE id_detalle='$idDetalle'
	",$conexion)or die(mysql_error());

	?>
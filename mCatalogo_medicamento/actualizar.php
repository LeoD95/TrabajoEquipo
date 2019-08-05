<?php
//se manda llamar la conexion.
include("../conexion/conexion.php");

$nombre    = $_POST["nombre"];
$codigo  = $_POST["codigo"];
$tmedicamento= $_POST["tmedicamento"];
$ide       = $_POST["ide"];



$nombre    =trim($nombre);
$codigo   =trim($codigo);
$tmedicamento    =trim($tmedicamento);

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE catalogo_medicamento SET
							nombre='$nombre',
							codigo='$codigo',
							tipo_medicamento='$tmedicamento',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='1'
						WHERE id_medicamento='$ide'
							 ",$conexion)or die(mysql_error());

?>
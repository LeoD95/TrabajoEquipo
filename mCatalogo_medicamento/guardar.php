<?php
//se manda llamar la conexion.
include("../conexion/conexion.php");

$nombre    = $_POST["nombre"];
$codigo= $_POST["codigo"];
$tmedicamento  = $_POST["tmedicamento"];


$nombre    =trim($nombre);
$codigo   =trim($codigo);
$tmedicamento    =trim($tmedicamento);


$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");
mysql_query("SET NAMES utf8");
 $insertar = mysql_query("INSERT INTO catalogo_medicamento 
 								(
 								nombre,
 								codigo,
								tipo_medicamento,
 								id_registro,
 								fecha_registro,
 								hora_registro,
 								activo
 								)
							VALUES
								(
 								'$nombre',
								 '$codigo',
 								'$tmedicamento',
 								'1',
 								'$fecha',
 								'$hora',
 								'1'
								)
							",$conexion)or die(mysql_error());




?>
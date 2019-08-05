<?php
//se manda llamar la conexion.
include("../conexion/conexion.php");

$nsucursal    = $_POST["nsucursal"];
$encargado= $_POST["encargado"];
$ubicacion  = $_POST["ubicacion"];


$nsucursal    =trim($nsucursal);
$encargado   =trim($encargado);
$ubicacion    =trim($ubicacion);


$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("INSERT INTO farmacias 
 								(
 								numero_farmacia,
 								ubicacion,
								encargado,
 								id_registro,
 								fecha_registro,
 								hora_registro,
 								activo
 								)
							VALUES
								(
 								'$nsucursal',
								 '$ubicacion',
 								'$encargado',
 								'1',
 								'$fecha',
 								'$hora',
 								'1'
								)
							",$conexion)or die(mysql_error());

echo $insertar;

?>
<?php
//se manda llamar la conexion.
include("../conexion/conexion.php");

$nombre    = $_POST["nombre"];
$nsucursal    = $_POST["nsucursal"];
$ubicacion  = $_POST["ubicacion"];
$encargado= $_POST["encargado"];
$ide       = $_POST["ide"];


$nombre    =trim($nombre);
$nsucursal    =trim($nsucursal);
$encargado   =trim($encargado);
$ubicacion    =trim($ubicacion);

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE farmacias SET
 							nombre='$nombre',
							numero_farmacia='$nsucursal',
							ubicacion='$ubicacion',
							encargado='$encargado',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='1'
						WHERE id_farmacia='$ide'
							 ",$conexion)or die(mysql_error());

?>
<?php
//se manda llamar la conexion
include("../conexion/conexion.php");

$nsucursal    = $_POST["numero_farmacia"];
$encargado= $_POST["encargado"];
$ubicacion  = $_POST["ubicacion"];
$ide       = $_POST["ide"];

$nsucursal    =trim($nsucursal);
$encargado   =trim($encargado);
$ubicacion    =trim($ubicacion);

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE farmacias SET
							numero_farmacia='$nsucursal',
							ubicacion='$ubicacion',
							encargado='$encargado',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='1'
						WHERE id_farmacia='$ide'
							 ",$conexion)or die(mysql_error());

?>
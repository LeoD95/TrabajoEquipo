<?php
	//se manda llamar la conexion
	include('../sesiones/verificar_sesion.php');

	$id_usuario =  $_SESSION["idUsuario"];

	$id_especialidad = $_POST["nombre_especialidadE"];
	$id_consultorio  = $_POST["nombre_consultorioE"];
	$ide             = $_POST["idE"];

	$cadena = mysql_query("UPDATE doctores SET id_especialidad = '$id_especialidad', id_consultorio = '$id_consultorio' WHERE id_doctor = '$ide'",$conexion);

	if(!empty($_FILES['cedula']['name'])){
		$tamano  = $_FILES["cedula"]['size'];
		$tipo    = $_FILES["cedula"]['type'];
		$archivo = $_FILES["cedula"]['name'];
		$prefijo = "P";

		$destino =  "cedulas/".$ide.".pdf";
		if (copy($_FILES['cedula']['tmp_name'],$destino)) 
		{
		    $status = "Archivo subido: <b>".$archivo."</b>";
		} 
		else 
		{
		    $status = "Error al subir el archivo";
		}
	}
	echo "ok";
?>
<?php
	//se manda llamar la conexion
	include('../sesiones/verificar_sesion.php');

	$id_usuario =  $_SESSION["idUsuario"];

	$id_persona      = $_POST["nombre_persona"];
	$id_especialidad = $_POST["nombre_especialidad"];
	$id_consultorio  = $_POST["nombre_consultorio"];

	$cadena = mysql_query("INSERT INTO doctores (id_persona,id_especialidad,id_consultorio,id_registro,fecha_registro,hora_registro,activo) VALUES ('$id_persona','$id_especialidad','$id_consultorio','$id_usuario','$fecha','$hora','1')",$conexion);

	if(!empty($_FILES['cedula']['name'])){
		$tamano  = $_FILES["cedula"]['size'];
		$tipo    = $_FILES["cedula"]['type'];
		$archivo = $_FILES["cedula"]['name'];
		$prefijo = "P";


		$cadena = mysql_query("SELECT MAX(id_doctor) FROM doctores",$conexion);
		$row = mysql_fetch_array($cadena);

		$destino =  "cedulas/".$row[0].".pdf";
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
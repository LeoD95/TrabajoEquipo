<?php
	include '../conexion/conexion.php';
	include '../sesiones/verificar_sesion.php';

	
	$idUsuario = $_SESSION["idUsuario"];
	
	// mysql_query("SET NAMES utf8");

    mysql_query("SET NAMES utf8");
    $consulta = mysql_query("SELECT
usuarios.id_usuario,
personas.nombre,
personas.ap_paterno,
personas.ap_materno,
personas.direccion,
personas.sexo,
personas.telefono,
personas.fecha_nacimiento,
personas.correo,
personas.tipo_persona,
usuarios.id_persona
FROM
usuarios
INNER JOIN personas ON usuarios.id_persona = personas.id_persona
WHERE id_usuario='$idUsuario'
AND personas.activo=1 AND usuarios.activo=1",$conexion)or die(mysql_error());

    $row = mysql_fetch_array($consulta);
    $nombre = $row[1];
    $apPaterno = $row[2];
    $apMaterno = $row[3];
    $direccion = $row[4];
    $sexo = $row[5];
    $telefono = $row[6];
    $cumple = $row[7];
    $correo = $row[8];
    $tipo_per = $row[9];
    $idPersona = $row[10];
    $mensaje = array($nombre,$apPaterno,$apMaterno,$direccion,
$sexo,
$telefono,
$cumple,
$correo,
$tipo_per, $idPersona); 
    echo json_encode($mensaje);
	
	// if (isset($buscarMat)) {
	// 		$consulta=mysql_query("SELECT 
	// 							id_alumno, 
	// 							CONCAT(p.nombre,' ',p.ap_paterno,' ',p.ap_materno) AS Persona,
	// 							(SELECT carreras.nombre FROM carreras WHERE carreras.id_carrera = alumnos.id_carrera) AS Carrera,
	// 							no_control,
	// 							p.sexo
	// 							FROM alumnos
	// 							INNER JOIN personas p ON p.id_persona = alumnos.id_persona
	// 							WHERE no_control = '$buscarMat' ",$conexion) or die (mysql_error());

	// 	$row = mysql_fetch_array($consulta);
	// 	$validar = mysql_num_rows($consulta);

	// 	if ($validar == 0) {
	// 		echo "La matricula no existe";
	// 	} 

	// 	else{
	// 		$foto ='../images/'.$row[3].'.jpg';
	// 	if (file_exists($foto)){
	// 		$imagen=$foto;
	// 	}else{
	// 		if ($row[4]=='M') {
	// 			$imagen='../images/hombre.jpg';
	// 		}else{
	// 			$imagen='../images/mujer.jpg';
	// 		}
	// 	}

	
	// 			$ide = $row[0];
	// 			$nombre = $row[1];
	// 			$carrera = $row[2];
	// 			//Output
	// 			$mensaje = array($ide,$nombre,$carrera,$imagen);  
				 

							
			
	// 	}
	// }


	// echo json_encode($mensaje);

?>
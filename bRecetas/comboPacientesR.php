<?php
include "../conexion/conexion.php";

mysql_query("SET NAMES utf8");

$consulta = mysql_query("SELECT 
                            id_paciente,
                            (SELECT CONCAT(p.nombre,' ',p.ap_paterno,' ',p.ap_materno) AS 'Nombre' 
                            FROM pacientes INNER JOIN personas p ON p.id_persona = pacientes.id_persona 
                            WHERE r.id_paciente = pacientes.id_paciente) AS Paciente

                            FROM recetas r

							",$conexion)or die(mysql_error());
?>
    <option value="0">Seleccione...</option>
<?php

while($row = mysql_fetch_row($consulta))
{  
	?>
    	<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
	<?php
}

?>
 
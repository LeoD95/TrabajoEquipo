<?php
include "../conexion/conexion.php";

mysql_query("SET NAMES utf8");

$consulta = mysql_query("SELECT personas.id_persona, CONCAT( personas.ap_paterno, ' ', personas.ap_materno, ' ', personas.nombre ) AS Persona 
	FROM pacientes
	RIGHT JOIN personas ON pacientes.id_persona = personas.id_persona 
	WHERE ISNULL (pacientes.id_persona)
	AND personas.activo = '1' AND personas.tipo_persona = 'paciente'
	ORDER BY personas.ap_paterno",$conexion)or die(mysql_error());
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
<script>
 $("#nombre_persona").select2();
</script>
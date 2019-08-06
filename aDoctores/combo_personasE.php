<?php
include "../conexion/conexion.php";

mysql_query("SET NAMES utf8");

$consulta = mysql_query("SELECT personas.id_persona, CONCAT( personas.ap_paterno, ' ', personas.ap_materno, ' ', personas.nombre ) AS Persona 
	FROM doctores
	RIGHT JOIN personas ON doctores.id_persona = personas.id_persona 
	WHERE personas.activo = '1' AND personas.tipo_persona = 'trabajador'
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
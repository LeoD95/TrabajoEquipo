<?php
include "../conexion/conexion.php";

mysql_query("SET NAMES utf8");

$consulta = mysql_query("SELECT 
							id_doctor,
						(SELECT CONCAT(p.nombre,' ',p.ap_paterno,' ',p.ap_materno) AS 'Nombre'
						 FROM doctores 
						 INNER JOIN personas p ON p.id_persona = doctores.id_persona 
						 WHERE doctores.id_doctor = doctores.id_doctor) AS Doctor
						 FROM doctores
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
<script>
 $("#idDoctor").select2();
</script> 
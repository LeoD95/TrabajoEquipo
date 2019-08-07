<?php
include "../conexion/conexion.php";

mysql_query("SET NAMES utf8");

            $consulta = mysql_query("SELECT
                                r.id_medicamento,
                                c.nombre 
                                FROM
                                recetas r
                                INNER JOIN catalogo_medicamento c ON r.id_medicamento = c.id_medicamento
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
 
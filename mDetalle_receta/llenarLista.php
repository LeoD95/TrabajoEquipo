<?php 
// Conexion a la base de datos
include'../conexion/conexion.php';

// Codificacion de lenguaje
mysql_query("SET NAMES utf8");

// Consulta a la base de datos
$consulta=mysql_query("SELECT
	d.id_detalle, r.id_receta,
	
	(SELECT nombre FROM catalogo_medicamento WHERE d.id_medicamento = catalogo_medicamento.id_medicamento) AS Medicamento,
	d.cantidad,
	r.codigo_receta,
	d.id_registro,
	d.fecha_registro,
	d.hora_registro,
	d.activo,
	d.id_medicamento							
	
	FROM detalle_receta d
	INNER JOIN recetas r ON d.id_receta = r.id_receta
	",$conexion) or die (mysql_error());
// $row=mysql_fetch_row($consulta)
	?>
	<div class="table-responsive">
		<table id="example1" class="table table-responsive table-condensed table-bordered table-striped">

			<thead align="center">
				<tr class="info" >
					<th>#</th>
					
					<th>Medicamento</th>										
					<th>Cantidad</th>
					<th>Codigo</th>
					<th>Editar</th>
					<th>Estatus</th>
				</tr>
			</thead> 

			<tbody align="center">
				<?php 
				$n=1;
				while ($row=mysql_fetch_row($consulta)) {
					$idDetalle    = $row[0];
					$idReceta	    = $row[1];
					$idMedicamento = $row[2];
					$cantidad = $row[3];
					$codigo   = $row[4];
					$activo = $row[8];
					$idMed = $row[9];
					$checado=($activo==1)?'checked':'';		
					$desabilitar=($activo==0)?'disabled':'';
					$claseDesabilita=($activo==0)?'desabilita':'';
					?>
					<tr>
						<td >
							<p id="<?php echo "tConsecutivo".$n; ?>" class="<?php echo $claseDesabilita; ?>">
								<?php echo "$n"; ?>
							</p>
						</td>
						
						<td>
							<p id="<?php echo "tidMedicamento".$n; ?>" class="<?php echo $claseDesabilita; ?>">
								<?php echo $idMedicamento; ?>
							</p>
						</td>
						<td>
							<p id="<?php echo "tcantidad".$n; ?>"  class="<?php echo $claseDesabilita; ?>">
								<?php echo $cantidad; ?>
							</p>
						</td>
						<td>
							<p id="<?php echo "tcodigo".$n; ?>" class="<?php echo $claseDesabilita; ?>">
								<?php echo $codigo; ?>
							</p>	
						</td>
						<td>
							<button id="<?php echo "boton".$n; ?>" <?php echo $desabilitar ?>  type="button" class="btn btn-login btn-sm" 
								onclick="abrirModalEditar(
									
									'<?php echo $idReceta ?>',
									'<?php echo $idMed ?>',
									'<?php echo $cantidad ?>',
									'<?php echo $idDetalle ?>'
									);">
									<i class="far fa-edit"></i>
								</button>
							</td>
							<td>
								<input  data-size="small" data-style="android" value="<?php echo "$valor"; ?>" type="checkbox" <?php echo "$checado"; ?>  id="<?php echo "interruptor".$n; ?>"  data-toggle="toggle" data-on="Desactivar" data-off="Activar" data-onstyle="danger" data-offstyle="success" class="interruptor" data-width="100" onchange="status(<?php echo $n; ?>,<?php echo $idPersona; ?>);">
							</td>
						</tr>
						<?php
						$n++;
					}
					?>

				</tbody>

				<tfoot align="center">
					<tr class="info">
						<th>#</th>
						
						<th>Medicamento</th>
						
						<th>Cantidad</th>
						<th>Codigo</th>
						<th>Editar</th>
						<th>Estatus</th>
					</tr>
				</tfoot>
			</table>
		</div>
		
		<script type="text/javascript">
			$(document).ready(function() {
				$('#example1').DataTable( {
					"language": {
                         // "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                         "url": "../plugins/datatables/langauge/Spanish.json"
                     },
                     "order": [[ 0, "asc" ]],
                     "paging":   true,
                     "ordering": true,
                     "info":     true,
                     "responsive": true,
                     "searching": true,
                     stateSave: false,
                     dom: 'Bfrtip',
                     lengthMenu: [
                     [ 10, 25, 50, -1 ],
                     [ '10 Registros', '25 Registros', '50 Registros', 'Todos' ],
                     ],
                     columnDefs: [ {
                      // targets: 0,
                      // visible: false
                  }],
                  buttons: [
                            // {
                            //     extend: 'pageLength',
                            //     text: 'Registros',
                            //     className: 'btn btn-default'
                            // },
                          /*  {
                            	extend: 'excel',
                            	text: 'Exportar a Excel',
                            	className: 'btn btn-login',
                            	title:'Bajas-Estaditicas',
                            	exportOptions: {
                            		columns: ':visible'
                            	}
                            }*/,
                            {
                            	text: 'Nueva Receta',
                            	action: function (  ) {
                            		ver_alta();
                            	},
                            	className: 'btn btn-login',
                            	counter: 1
                            },
                            ]
                        } );
			} );

		</script>
		<script>
			$(".interruptor").bootstrapToggle('destroy');
			$(".interruptor").bootstrapToggle();
		</script>
		
		

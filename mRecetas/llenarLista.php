<?php 
// Conexion a la base de datos
include'../conexion/conexion.php';

// Codificacion de lenguaje
mysql_query("SET NAMES utf8");

// Consulta a la base de datos
$consulta=mysql_query("SELECT
							recetas.id_receta,
					 (SELECT CONCAT(p.nombre,' ',p.ap_paterno,' ',p.ap_materno) AS 'Nombre' FROM pacientes INNER JOIN personas p ON p.id_persona = pacientes.id_persona WHERE pacientes.id_paciente = recetas.id_paciente) AS Paciente,
					 (SELECT CONCAT(p.nombre,' ',p.ap_paterno,' ',p.ap_materno) AS 'Nombre' FROM doctores INNER JOIN personas p ON p.id_persona = doctores.id_persona WHERE doctores.id_doctor = recetas.id_doctor) AS Doctor,
								descripcion,
					 (SELECT nombre FROM catalogo_medicamento WHERE recetas.id_medicamento = catalogo_medicamento.id_medicamento) AS Medicamento,
								cantidad,
								codigo_receta,
								id_registro,
								fecha_registro,
								hora_registro, 
								activo,
								id_paciente,
								id_doctor,
								id_medicamento								
						FROM recetas
						ORDER BY id_paciente DESC",$conexion) or die (mysql_error());
// $row=mysql_fetch_row($consulta)
 ?>
				            <div class="table-responsive">
				                <table id="example1" class="table table-responsive table-condensed table-bordered table-striped">

				                    <thead align="center">
				                      <tr class="info" >
				                        <th>#</th>
										<th>Paciente</th>
				                        <th>Doctor</th>
				                        <th>Descripcion</th>
										<th>Medicamento</th>
				                        <th>Cantidad</th>
										<th>Codigo Receta</th>
				                        <th>Editar</th>
				                        <th>Estatus</th>
				                      </tr>
				                    </thead> 

				                    <tbody align="center">
				                    <?php 
				                    $n=1;
				                    while ($row=mysql_fetch_row($consulta)) {
										$idReceta    = $row[0];
										$idPaciente  = $row[1];
										$idDoctor    = $row[2];
										$descripcion = $row[3];
										$idMedicamento   = $row[4];
										$cantidad    = $row[5];
										$codigoReceta   = $row[6];
										$activo   = $row[10];	
										$checado=($activo==1)?'checked':'';		
										$desabilitar=($activo==0)?'disabled':'';
										$claseDesabilita=($activo==0)?'desabilita':'';

										$id_pac = $row[11];
										$id_doc = $row[12];
										$id_med = $row[13];
									?>
				                      <tr>
				                        <td >
				                          <p id="<?php echo "tConsecutivo".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo "$n"; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tidPaciente".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $idPaciente; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tidDoctor".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $idDoctor; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tdescripcion".$n; ?>"  class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $descripcion; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tidMedicamento".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $idMedicamento; ?>
				                          </p>	
																</td>
											<td>
																<p id="<?php echo "tcantidad".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $cantidad; ?>
				                          </p>	
											</td>
											<td>
																<p id="<?php echo "tcodigo_receta".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $codigoReceta; ?>
				                          </p>	
											</td>
				                        <td>
				                          <button id="<?php echo "boton".$n; ?>" <?php echo $desabilitar ?>  type="button" class="btn btn-login btn-sm" 
				                          onclick="abrirModalEditar(
				                          							
				                          							'<?php echo $id_pac ?>',
				                          							'<?php echo $id_doc ?>',
				                          							'<?php echo $descripcion ?>',
				                          							'<?php echo $id_med ?>',
				                          							'<?php echo $cantidad ?>',
															        '<?php echo $codigoReceta ?>',
										  							'<?php echo $idReceta ?>'
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
				                        <th>Paciente</th>
				                        <th>Doctor</th>
				                        <th>Descripcion</th>
										<th>Medicamento</th>
				                        <th>Cantidad</th>
										<th>Codigo Medicamento</th>
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
                          /*{
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
									  llenar_paciente();
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
    
    

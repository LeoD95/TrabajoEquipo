<?php 
// Conexion a la base de datos
include'../conexion/conexion.php';

// Codificacion de lenguaje
mysql_query("SET NAMES utf8");

// Consulta a la base de datos
$consulta=mysql_query("SELECT
							id_pedido,
							( SELECT nombre FROM catalogo_medicamento cm WHERE cm.id_medicamento = pedidos.id_medicamento ) AS Medicamento,
							cantidad,
							( SELECT ubicacion FROM farmacias f WHERE f.id_farmacia = pedidos.id_farmacia ) AS Farmacia,
							id_registro,
							activo 
							FROM
							pedidos" 	
						,$conexion) or die (mysql_error());
// $row=mysql_fetch_row($consulta)
 ?>
				            <div class="table-responsive">
				                <table id="example1" class="table table-responsive table-condensed table-bordered table-striped">

				                    <thead align="center">
				                      <tr class="info" >
				                        <th>#</th>
				                        <th>Medicamento</th>
				                        <th>Cantidad</th>
										<th>Farmacia</th>
				                        <th>Registro</th>
				                        <th>Editar</th>
										<th>Estatus</th>
				                      </tr>
				                    </thead>

				                    <tbody align="center">
				                    <?php 
				                    $n=1;
				                    while ($row=mysql_fetch_row($consulta)) {
										$idPedido      = $row[0];
										$Medicamento           = $row[1];
										$Farmacia         = $row[2];
										$activo            = $row[3];

										$checado         = ($activo == 1)?'checked' : '';		
										$desabilitar     = ($activo == 0)?'disabled': '';
										$claseDesabilita = ($activo == 0)?'desabilita':'';
															?>
				                      <tr>
				                        <td >
				                          <p id="<?php echo "tConsecutivo".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo "$n"; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "t".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $nomUsuarioCompleto; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tUsuario".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $usuario; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tRegistro".$n; ?>"  class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $registro; ?>
				                          </p>
				                        </td>	
				                        <td>
				                          <button id="<?php echo "botonR".$n; ?>" <?php echo $desabilitar ?>  type="button" class="btn btn-login btn-sm" 
				                          onclick="restaurarContra(
				                          							'<?php echo $idUsuario ?>'
				                          							);">
				                          	<i class="fas fa-sync-alt"></i>
				                          </button>
				                        </td>
				                        <td>
				                          <button id="<?php echo "boton".$n; ?>" <?php echo $desabilitar ?>  type="button" class="btn btn-login btn-sm" 
				                          onclick="abrirModalEditar(
				                          							'<?php echo $idPedido  ?>',
				                          							'<?php echo $Medicamento ?>',
				                          							'<?php echo $Farmacia ?>'
				                          							);">
				                          	<i class="far fa-edit"></i>
				                          </button>
				                        </td>
				                        <td>
											<input  data-size="small" data-style="android" value="<?php echo "$valor"; ?>" type="checkbox" <?php echo "$checado"; ?>  id="<?php echo "interruptor".$n; ?>"  data-toggle="toggle" data-on="Desactivar" data-off="Activar" data-onstyle="danger" data-offstyle="success" class="interruptor" data-width="100" onchange="status(<?php echo $n; ?>,<?php echo $idUsuario; ?>);">
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
										<th>Farmacia</th>
				                        <th>Registro</th>
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
                            {
                                extend: 'pageLength',
                                text: 'Registros',
                                className: 'btn btn-login'
                            },
                          {
                              extend: 'excel',
                              text: 'Exportar a Excel',
                              className: 'btn btn-login',
                              title:'Bajas-Estaditicas',
                              exportOptions: {
                                  columns: ':visible'
                              }
                          },
                         {
							  text: 'Nuevo Usuario',
							  className: 'btn btn-login',
                              action: function (  ) {
								ver_alta();
								llenar_persona();
                              },
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
    
    

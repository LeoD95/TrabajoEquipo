<?php 
// Conexion a la base de datos
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

// Codificacion de lenguaje
mysql_query("SET NAMES utf8");

// Consulta a la base de datos
$consulta=mysql_query("SELECT
	id_paciente,
	id_persona,
	(
	SELECT
		CONCAT( personas.nombre, ' ', personas.ap_paterno, ' ', personas.ap_materno ) 
	FROM
		personas 
	WHERE
		personas.id_persona = pacientes.id_persona 
	) AS Nomb,
	numero_seguro,
CASE
		tipo_sangre 
		WHEN '1' THEN
		'A+' 
		WHEN '2' THEN
		'A-' ELSE 'B+' 
	END AS tipo_sangre,
	tipo_sangre,
	estatura,
	peso,
	activo 
FROM
	pacientes",$conexion) or die (mysql_error());
// $row=mysql_fetch_row($consulta)
 ?>
				            <div class="table-responsive">
				                <table id="example1" class="table table-responsive table-condensed table-bordered table-striped">

				                    <thead align="center">
				                      <tr class="info" >
				                        <th>#</th>
				                        <th>Nombre Paciente</th>
				                        <th>Numero Seguro</th>
				                        <th>Tipo Sangre</th>
				                        <th>Estatura</th>
				                        <th>Peso</th>
										<th>Alergias</th>
				                        <th>Editar</th>
										<th>Estatus</th>
				                      </tr>
				                    </thead>

				                    <tbody align="center">
				                    <?php 
										$n=1;
										while ($row=mysql_fetch_row($consulta)) {
											$idPaciente    = $row[0];
											$idPersona     = $row[1];
											$nombre        = $row[2];
											$numero_seguro = $row[3];
											$tipo_sangre   = $row[4];
											$tipo_sangre1  = $row[5];
											$estatura      = $row[6];
											$peso          = $row[7];
											$activo        = $row[8];

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
											<p id="<?php echo "tNcompleto".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $nombre; ?>
				                          </p>
				                        </td>
				                        <td>
											<p id="<?php echo "tseguro".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $numero_seguro; ?>
				                          </p>
				                        </td>
				                        <td>
											<p id="<?php echo "tsangre".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $tipo_sangre; ?>
				                          </p>
				                        </td>
				                        <td>
											<p id="<?php echo "testatura".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $estatura; ?>
				                          </p>
				                        </td>
				                        <td>
											<p id="<?php echo "tpeso".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $peso; ?>
				                          </p>
				                        </td>
										<td>
				                          <button id="<?php echo "botonA".$n; ?>" <?php echo $desabilitar ?> type="button" class="btn btn-login btn-sm" 
				                          onclick="abrirModalAlergias(
				                          	'<?php echo $idPaciente  ?>',
				                          	'<?php echo $idPersona ?>'
				                          	);">
				                          	<i class="fab fa-amilia"></i>
				                          </button>
				                        </td>	
				                        <td>
				                          <button id="<?php echo "boton".$n; ?>" <?php echo $desabilitar ?> type="button" class="btn btn-login btn-sm" 
				                          onclick="abrirModalEditar(
				                          	'<?php echo $idPaciente  ?>',
				                          	'<?php echo $idPersona ?>',
				                          	'<?php echo $numero_seguro ?>',
				                          	'<?php echo $tipo_sangre1 ?>',
				                          	'<?php echo $estatura ?>',
				                          	'<?php echo $peso ?>'
				                          	);">
				                          	<i class="far fa-edit"></i>
				                          </button>
				                        </td>
				                        <td>
											<input data-size="small" data-style="android" value="<?php echo "$valor"; ?>" type="checkbox" <?php echo "$checado"; ?>  id="<?php echo "interruptor".$n; ?>"  data-toggle="toggle" data-on="Desactivar" data-off="Activar" data-onstyle="danger" data-offstyle="success" class="interruptor" data-width="100" onchange="status(<?php echo $n; ?>,<?php echo $idPaciente; ?>);">
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
				                        <th>Nombre Paciente</th>
				                        <th>Numero Seguro</th>
				                        <th>Tipo Sangre</th>
				                        <th>Estatura</th>
				                        <th>Peso</th>
										<th>Alergias</th>
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
                              extend: 'excel',
                              text: 'Exportar a Excel',
                              className: 'btn btn-login',
                              title:'Bajas-Estaditicas',
                              exportOptions: {
                                  columns: ':visible'
                              }
                          },
                         {
							  text: 'Nuevo Paciente',
							  className: 'btn btn-login',
                              action: function (  ) {
								ver_alta();
								combo_personas();
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
    
    

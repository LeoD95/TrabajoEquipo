<?php 
// Conexion a la base de datos
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

// Codificacion de lenguaje
mysql_query("SET NAMES utf8");

// Consulta a la base de datos
$consulta=mysql_query("SELECT id_doctor,
	(SELECT CONCAT(personas.nombre,' ',personas.ap_paterno,' ',personas.ap_materno) FROM personas WHERE personas.id_persona = doctores.id_persona) AS Doctor,
	(SELECT nombre FROM especialidades WHERE especialidades.id_especialidad = doctores.id_especialidad) AS Especialidad,
	cedula,
	(SELECT nombre FROM consultorios WHERE consultorios.id_consultorio = doctores.id_consultorio) AS Consultorio,
	activo,
	id_persona,
	id_especialidad,
	id_consultorio
	FROM doctores",$conexion) or die (mysql_error());
// $row=mysql_fetch_row($consulta)
 ?>
    <div class="table-responsive">
        <table id="example1" class="table table-responsive table-condensed table-bordered table-striped">

            <thead align="center">
              <tr class="info" >
                <th>#</th>
                <th>Nombre Doctos</th>
                <th>Especialidad</th>
                <th>Consultorio</th>
                <th>Cedula</th>
                <th>Editar</th>
				<th>Estatus</th>
              </tr>
            </thead>

            <tbody align="center">
            <?php 
				$n=1;
				while ($row=mysql_fetch_row($consulta)) {
					$idDoctor        = $row[0];
					$nombre          = $row[1];
					$especialidad    = $row[2];
					$cedula          = $row[3];
					$consultorio     = $row[4];
					$activo          = $row[5];
					$id_persona      = $row[6];
					$id_especialidad = $row[7];
					$id_consultorio  = $row[8];

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
					<p id="<?php echo "tNespecialidad".$n; ?>" class="<?php echo $claseDesabilita; ?>">
                  	<?php echo $especialidad; ?>
                  </p>
                </td>
                <td>
					<p id="<?php echo "tNconsultorio".$n; ?>" class="<?php echo $claseDesabilita; ?>">
                  	<?php echo $consultorio; ?>
                  </p>
                </td>
                <td>
                  	<a href="cedulas/<?php echo $idDoctor;?>.pdf" target="_blank" class='btn btn-login btn-sm' id="<?php echo "tNcedula".$n; ?>"><i class="fas fa-ad"></i></a>
                </td>	
                <td>
                  <button id="<?php echo "boton".$n; ?>" <?php echo $desabilitar ?> type="button" class="btn btn-login btn-sm" 
                  onclick="abrirModalEditar(
                  							'<?php echo $idDoctor  ?>',
                  							'<?php echo $id_persona ?>',
                  							'<?php echo $id_especialidad ?>',
                  							'<?php echo $cedula ?>',
                  							'<?php echo $id_consultorio ?>'
                  							);">
                  	<i class="far fa-edit"></i>
                  </button>
                </td>
                <td>
					<input data-size="small" data-style="android" value="<?php echo "$valor"; ?>" type="checkbox" <?php echo "$checado"; ?>  id="<?php echo "interruptor".$n; ?>"  data-toggle="toggle" data-on="Desactivar" data-off="Activar" data-onstyle="danger" data-offstyle="success" class="interruptor" data-width="100" onchange="status(<?php echo $n; ?>,<?php echo $idDoctor; ?>);">
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
                <th>Nombre Doctos</th>
                <th>Especialidad</th>
                <th>Consultorio</th>
                <th>Cedula</th>
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
							  text: 'Nuevo Doctor',
							  className: 'btn btn-login',
		                      action: function (  ) {
								ver_alta();
								combo_personas();
								combo_especialidades();
								combo_consultorios();
		                      },
		                      counter: 1
		                  },
		          ]
		      } );
		});
	</script>
	<script>
	    $(".interruptor").bootstrapToggle('destroy');
	    $(".interruptor").bootstrapToggle();
	</script>
    
    

<?php 
// Conexion a la base de datos
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$idPaciente = $_POST['idPaciente'];

// Codificacion de lenguaje
mysql_query("SET NAMES utf8");

// Consulta a la base de datos
$consulta=mysql_query("SELECT id_detalle_paciente,
                                id_paciente,
                                id_medicamento,
                                (SELECT nombre FROM catalogo_medicamento WHERE catalogo_medicamento.id_medicamento = detalle_paciente.id_medicamento),comentario,
                                activo FROM detalle_paciente WHERE activo = '1' AND id_paciente = '$idPaciente'",$conexion) or die (mysql_error());
// $row=mysql_fetch_row($consulta)
 ?>
    <div class="table-responsive">
        <table id="exampleA" class="table table-responsive table-condensed table-bordered table-striped">

            <thead align="center">
                <tr class="info" >
                <th>#</th>
                <th>Medicamento</th>
                <th>Comentario</th>
                <th>Editar</th>
                <th>Estatus</th>
                </tr>
            </thead>

            <tbody align="center">
            <?php 
                $n=1;
                while ($rowA=mysql_fetch_row($consulta)) {
                    $idDetalle     = $rowA[0];
                    $idPaciente    = $rowA[1];
                    $idMedicamento = $rowA[2];
                    $medicamento   = $rowA[3];
                    $comentario    = $rowA[4];
                    $activo        = $rowA[5];

                    $checado         = ($activo == 1)?'checked' : '';		
                    $desabilitar     = ($activo == 0)?'disabled': '';
                    $claseDesabilita = ($activo == 0)?'desabilita':'';
            ?>
                <tr>
                <td >
                    <p id="<?php echo "tConsecutivoA".$n; ?>" class="<?php echo $claseDesabilita; ?>">
                    <?php echo "$n"; ?>
                    </p>
                </td>
                <td>
                    <p id="<?php echo "tMedicamentoA".$n; ?>" class="<?php echo $claseDesabilita; ?>">
                    <?php echo $medicamento; ?>
                    </p>
                </td>
                <td>
                    <p id="<?php echo "tComentarioA".$n; ?>" class="<?php echo $claseDesabilita; ?>">
                    <?php echo $comentario; ?>
                    </p>
                </td>	
                <td>
                    <button id="<?php echo "botonA".$n; ?>" <?php echo $desabilitar ?> type="button" class="btn btn-login btn-sm" 
                    onclick="editarAlergia(
                    '<?php echo $idDetalle  ?>'
                    );">
                    <i class="far fa-edit"></i>
                    </button>
                </td>
                <td>
                   <button class="btn btn-login btn-sm" type="button" onclick="eliminar('<?php echo $idDetalle?>')"><i class="fa fa-trash"></i></button>
                </td>
                </tr>
                <?php
                $n++;
            }
                ?>

            </tbody>

            <tfoot align="center">
                <tr class="info">
                <th width="5%">#</th>
                <th>Medicamento</th>
                <th>Comentario</th>
                <th width="5%">Editar</th>
                <th width="5%">Estatus</th>
                </tr>
            </tfoot>
        </table>
    </div>
			
    <script type="text/javascript">
    $(document).ready(function() {
            $('#exampleA').DataTable( {
                "language": {
                        // "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                        "url": "../plugins/datatables/langauge/Spanish.json"
                    },
                "order": [[ 0, "asc" ]],
                "paging":   false,
                "ordering": false,
                "info":     false,
                "responsive": true,
                "searching": false,
                stateSave: false,
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 Registros', '25 Registros', '50 Registros', 'Todos' ],
                ],
                columnDefs: [ {
                    // targets: 0,
                    // visible: false
                }],
            } );
        } );

    </script>
    <script>
        $(".interruptor").bootstrapToggle('destroy');
        $(".interruptor").bootstrapToggle();
    </script>
    
    

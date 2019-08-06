<?php 
include("../sesiones/verificar_sesion.php");
include'../conexion/conexion.php';

// Variables de configuración
$titulo="Catálago de Farmacias";
$opcionMenu="A";

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="../img/logo.png">
	<title >Sucursales </title>

	<!-- Meta para compatibilidad en disposqqqitivos mobiles -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" type="text/css" href="../plugins/bootstrap/css/bootstrap.min.css">

    <!-- fontawesome -->
	<link rel="stylesheet" href="../plugins/fontawesome-free-5.8.1-web/css/all.min.css">

	<!-- DataTableButtons -->
    
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

    <!-- bootstrap-toggle-master -->
    <link href="../plugins/bootstrap-toggle-master/css/bootstrap-toggle.css" rel="stylesheet">
    <link href="../plugins/bootstrap-toggle-master/stylesheet.css" rel="stylesheet">
	
	<!-- select2 -->
    <link rel="stylesheet" href="../plugins/select2/select2.css">

	<!-- Estilos propios -->
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">

	<!-- Alertify	 -->
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/themes/bootstrap.css">
</head>

<body>
	<header>
		<?php 
			include('../layout/encabezado.php');
		 ?>
	</header><!-- /header -->	
	<div class="container-fluid" >
		<div class="row">
			<div class="col-xs-0 col-sm-3 col-md-2 col-lg-2 vertical">
			<?php 
				include('menuv.php');
			 ?>
			</div>
			<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10 cont">
			   <div class="titulo borde sombra">
			        <h3><?php echo $titulo; ?></h3>
			   </div>	
			   <div class="contenido borde sombra">
				    <div class="container-fluid">
				        <section id="alta" style="display: none">
            				<form id="frmAlta">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="nombre">Nombre de la farmacia:</label>
												<input type="text" id="nombre" class="form-control " required="" placeholder="Escribe el numero de la sucursal">
											</div>
									</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="nombre">Encargado:</label>
												<input type="text" id="encargado" class="form-control " autofocus="" required="" placeholder="Escribe el nombre del encargado">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="nombre">Ubicacion:</label>
												<input type="text" id="ubicacion" class="form-control " autofocus="" required="" placeholder="Escribe las ubicacion">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="abreviatura">Numero de la sucursal:</label>
												<input type="text" id="nsucursal" class="form-control " required="" placeholder="Escribe el numero de la sucursal">
											</div>
										</div>	
									</div>								
								
								<div class="row">
									<div class="col-lg-12">
										<button type="button" id="btnLista" class="btn btn-login  btn-flat  pull-left">Lista de Sucursales</button>
										<input type="submit" class="btn btn-login  btn-flat  pull-right" value="Guardar Información">										
									</div>
								</div>
            				</form>
				        </section>

				        <section id="lista" style="width: 100%">
            
				        </section>
				    </div>
			   </div>	

			</div>			
		</div>
	</div>
	<footer class="fondo">
		<?php 
			include('../layout/pie.php');
		 ?>			

	</footer>

	<!-- Modal -->
	<div id="modalEditar" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">

	    <!-- Modal content-->
	    <form id="frmActuliza">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Editar datos de la sucursal</h4>
	      </div>
	      <div class="modal-body">
				<input type="hidden" id="idE">
				<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="nombre">Nombre de la farmacia:</label>
												<input type="text" id="nombreE" class="form-control " required="" placeholder="Escribe el numero de la sucursal">
											</div>
									</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="nombre">Encargado:</label>
												<input type="text" id="encargadoE" class="form-control " autofocus="" required="" placeholder="Escribe el nombre del encargado">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="nombre">Ubicacion:</label>
												<input type="text" id="ubicacionE" class="form-control " autofocus="" required="" placeholder="Escribe las ubicacion">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="abreviatura">Numero de la sucursal:</label>
												<input type="text" id="nsucursalE" class="form-control " required="" placeholder="Escribe el numero de la sucursal">
											</div>
										</div>	
													
					<hr class="linea">
				</div>
	      </div>
	      <div class="modal-footer">
				<div class="row">
					<div class="col-lg-12">
						<button type="button" id="btnCerrar" class="btn btn-login  btn-flat  pull-left" data-dismiss="modal">Cerrar</button>
						<input type="submit" class="btn btn-login  btn-flat  pull-right" value="Actualizar Información">	
					</div>
				</div>
	      </div>
	    </div>
		</form>
	  </div>
	</div>
	<!-- Modal -->

	<!-- ENLACE A ARCHIVOS JS -->

	<!-- jquery -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

	<!-- Preloaders -->
    <script src="../plugins/Preloaders/jquery.preloaders.js"></script>

	<!-- bootstrap-toggle-master -->
    <script src="../plugins/bootstrap-toggle-master/doc/script.js"></script>
    <script src="../plugins/bootstrap-toggle-master/js/bootstrap-toggle.js"></script>

 	 <!-- dataTableButtons -->
    <script type="text/javascript" src="../plugins/dataTableButtons/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/buttons.flash.min.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/jszip.min.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/pdfmake.min.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/vfs_fonts.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/buttons.html5.min.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/buttons.print.min.js"></script>
	
	<!-- alertify -->
	<script type="text/javascript" src="../plugins/alertifyjs/alertify.js"></script>

    <!-- Funciones propias -->
    <script src="funciones.js"></script>
    <script src="../js/menu.js"></script>
    <script src="../js/precarga.js"></script>
    <script src="../js/salir.js"></script>

    <!-- LLAMADAS A FUNCIONES E INICIALIZACION DE COMPONENTES -->

    <!-- Llamar la funcion para llenar la lista -->
	<script type="text/javascript">
	  llenar_lista();

	  function cambiar_contra(){
            $("#modalContra").modal("show");
            $("#frmContra")[0].reset();
            $('#modalContra').on('shown.bs.modal', function () {
                $('#pass').focus();            
            }); 
        }
                        function actualizar_pass(){
            var pass   = $("#pass").val();
            $.ajax({
                url:"../sesiones/actualizar_pass2.php",
                type:"POST",
                dateType:"html",
                data:{
                    'pass':pass
                },
                success:function(respuesta){
                    alertify.warning(respuesta);
                if (respuesta == "ok"){
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success('Se ha actualizado la contraseña' );
                    $("#frmContra")[0].reset();
                    $("#modalContra").modal("hide");
                }else{
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.error('La contraseña es igual a la Anterior' );
                }
                },
                error:function(xhr,status){
                    alert(xhr);
                },
            });
        }
	</script>

    <!-- Inicializador de elemento -->
     <script>
      $(function () {
        $(".select2").select2();
        
      });
    </script> 

	<script>
		var letra ='<?php echo $opcionMenu; ?>';
		$(document).ready(function() { menuActivo(letra); });
	</script>
	

	
	<script type="text/javascript" src="../plugins/stacktable/stacktable.js"></script> 
</body>
</html>
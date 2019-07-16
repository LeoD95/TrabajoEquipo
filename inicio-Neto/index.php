<?php 
	include('../sesiones/verificar_sesion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistema de Registros de Alumnos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="../plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../plugins/fontawesome-free-5.8.1-web/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<!-- Alertify	 -->
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/themes/bootstrap.css">
	<!-- fileinput -->
	<link href="../plugins/bootstrap-fileinput-master/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
	<header>
		<?php 
			include('../layout/encabezado.php');
		 ?>
	</header><!-- /header -->	
	<div class="container-fluid" >
		<div class="row" id="cuerpo" style="display:none">
			<div class="col-xs-0 col-sm-3 col-md-2 col-lg-2">
				<?php 
					include('../layout/menuv.php');
				?>
			</div>

			<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10 cont">
			   <div class="titulo borde sombra">
			        <h3 class="titular">Panel Inicial</h3>
			   </div>	
			   <div class="contenido borde sombra" style="padding-right:18px;">
					<section id="panel">

					</section>
					<section id="misDatos">

					</section>
					<section id="miFoto">

					</section>
				</div>
			</div>			
		</div>
	</div>
	<footer class="fondo">
		<?php 
			include('../layout/pie.php');
		 ?>			

	</footer>
	<div id="modalContra" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <form id="frmContra">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Actualizar Contraseña</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <label for="pass">Contraseña Nueva:</label>
                                    <input onkeyup="verificar_pass()" type="password" id="pass" class="form-control " autofocus="" required="" placeholder="Escribe la contraseña">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <label for="pass1">Confirma Contraseña:</label>
                                    <input onkeyup="verificar_pass()" type="password" id="pass1" class="form-control " required="" placeholder="Confirma la contraseña">
                                </div>
                            </div>
                            <hr class="linea">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="button" id="btnCerrar" class="btn btn-login  btn-flat  pull-left" data-dismiss="modal">Cerrar</button>
                                <input disabled = "disabled" id="btn_actualizar_pass" type="submit" class="btn btn-login  btn-flat  pull-right" value="Actualizar Contraseña" onclick="actualizar_pass()">	
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
	<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- Preloaders -->
    <script src="../plugins/Preloaders/jquery.preloaders.js"></script>
	<script src="funciones.js"></script>
	<script src="../js/menu.js"></script>
	<script src="../js/precarga.js"></script>
	<script src="../js/salir.js"></script>
	<script src="../js/inicio.js"></script>
	<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- alertify -->
	<script type="text/javascript" src="../plugins/alertifyjs/alertify.js"></script>

	<script src="../plugins/bootstrap-fileinput-master/js/plugins/piexif.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/js/fileinput.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/js/locales/fr.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/js/locales/es.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/themes/fas/theme.js" type="text/javascript"></script>
	<script src="../plugins/bootstrap-fileinput-master/themes/explorer-fas/theme.js" type="text/javascript"></script>
	
	<script>
		window.onload = function() {
			$("#cuerpo").fadeIn("slow");
		};	
		$("#linkPanel").addClass("activo");
		llenarPanel();
	</script>
	<script>
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

        function verificar_pass(){
            var pass1 = $('#pass').val();
            var pass2 = $('#pass1').val();

            if(pass1.trim() != "" && pass2.trim() !=""){
                if(pass1 == pass2){
                    $('#btn_actualizar_pass').removeAttr('disabled');
                }else{
                    $('#btn_actualizar_pass').attr('disabled', 'disabled');
                }
            }else{
                $('#btn_actualizar_pass').attr('disabled', 'disabled');
            }
        }
	</script>
	<script type="text/javascript" src="../plugins/Smoothbox-master/js/smoothbox.min.js"></script>
</body>
</html>
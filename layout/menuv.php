				<div class="sidebar fondo borde fuenteAzul sombra vertical" >
					<h2 class="fondo">Menú</h2>
					<ul class="menuv">
						<li class="list-unstyled icoMedia">
							<a href="#" id="linkPanel"><i class="fas fa-home"></i> <label class="modulo">	Inicio</label></a>
						</li>
						<li class="list-unstyled icoMedia">
							<a href="#" onclick="misDatos('<?php echo $_SESSION["idUsuario"] ?>');" id="linkMisDatos"><i class="fas fa-user-circle"></i> <label class="modulo">	Mis Datos</label></a>
						</li>
						<li class="list-unstyled icoMedia">
							<a href="#" click id="linkMifoto">
								<i class="fas fa-camera"></i>
								<label class="modulo">Mi fotografía</label>
							</a> 
						</li >
						<li class="list-unstyled icoMedia">
							<a href="#" onclick="cambiar_contra();"><i class="fas fa-unlock-alt"></i> <label class="modulo">	Cambiar Contraseña</label></a></a>
						</li>
						<li class="list-unstyled divisor">
							<hr>
						</li>
						<li class="list-unstyled icoMedia modulo">
							<a href="#" onclick="salir();"><i class="fas fa-sign-out-alt"></i> <label class="modulo">	Salir</label></a></a>
						</li>
					</ul>
				</div>
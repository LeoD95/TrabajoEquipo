		<section class="contenedor iconos fondo">
			<ul class="nav-pills pull-right menu-bar">
				<li class="list-unstyled ">
					<a href="#" class="color  borde" id="menuV">
						<i class="fas fa-bars"></i>
					</a>
				</li>
				<li class="list-unstyled modulo">
					<a href="#" class="color borde">
						<i class="far fa-user-circle"></i>
					</a>
				</li>
				<li class="list-unstyled modulo">
					<a href="#" onclick="cambiar_contra();" class="color borde">
						<i class="fas fa-unlock-alt"></i>
					</a>
				</li>
				<li class="list-unstyled modulo">
					<a href="../inicio/index.php" class="color borde">
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li class="list-unstyled modulo">
					<a href="#" onclick="salir();" class="color borde">
						<i class="fas fa-sign-out-alt"></i>
					</a>
				</li>

				<h2 class="fondo aparece der"><?php echo $_SESSION["nCompleto"];?></h2>

			</ul>

			<h2 class="fondo aparece  izq"><?php echo $_SESSION["nCompleto"];?></h2>
			<h2 class="fondo aparece  empresa">Hospital General de Linares</h2>
			
		</section>
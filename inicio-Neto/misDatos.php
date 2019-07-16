
<br>
<form id="frmActuliza">
	<div class="row">
		<div class="container-fluid">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-6">
				<div class="form-group">
					<input type="hidden" id="persona" class="form-control">
					<label for="nombre">Nombre de la Persona:</label>
					<input type="text" id="nombre" class="form-control " autofocus="" required="" placeholder="Escribe el nombre">
				</div>
			</div>
			<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
				<div class="form-group">
					<label for="paterno">Apellido Paterno:</label>
					<input type="text" id="paterno" class="form-control " required="" placeholder="Escribe el apellido">
				</div>
			</div>
			<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
				<div class="form-group">
					<label for="materno">Apellido Materno:</label>
					<input type="text" id="materno" class="form-control " required="" placeholder="Escribe el apellido">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group">
					<label for="direccion">Dirección:</label>
					<input type="text" id="direccion" class="form-control " required="" placeholder="Escribe la dirección completo">
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="form-group">
					<label for="sexo">Sexo:</label>
					<select  id="sexo" class="select2 form-control " style="width: 100%">
						<option value="M">Masculino</option>
						<option value="F">Femenino</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="form-group">
					<label for="Telefono">Teléfono:</label>
					<input type="text" id="telefono" class="form-control " required="" placeholder="Escribe el telefono">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="form-group">
					<label for="fecha_nac">Fecha de Nacimiento:</label>
					<input type="date" id="fecha_nac" class="form-control " required="" placeholder="yyyy-mm-dd" value="<?php echo $fecha;?>">
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-7 col-lg-8">
				<div class="form-group">
					<label for="correo">Correo:</label>
					<input type="text" id="correo" class="form-control " required="" placeholder="email">
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
				<div class="form-group">
					<label for="tipo">Tipo de persona:</label>
					<select  id="tipo" class="select2 form-control " style="width: 100%">
						<option value="estudiante">Estudiante</option>
						<option value="trabajador">Trabajador</option>
					</select>
				</div>
			</div>
			<hr class="linea">
		</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<button type="button" onclick="actualizar();" class="btn btn-login  btn-flat  pull-right" value="">Guardar Información</button>	
			</div>
		</div>
	
</form>


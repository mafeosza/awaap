<!DOCTYPE html>
<html>
<head>
	<title>Registro Profesor</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
</head>
<body>
	<div class="jumbotron">
		<div class="container text-center">
			<h1>Bienvenido</h1>
	  		<h2>Registro profesor</h2>
		</div>
	</div>
	<div class="container-fluid ">
		<form class="form-horizontal" action="" method="POST">
			<fieldset>
				<div id="legend">
					<legend >Ingresa los siguientes datos:</legend>
				</div>
				<div class="control-group">
					<!--Nombre-->
					<label class="control-label" for="nombre">Nombre</label>
					<div class="controls">
						<input type="text" id="nombre" name="nombre" placeholder="" class="input-xlarge">
						<p class="help-block">Por favor escribe tu nombre completo</p>
					</div>
				</div>

				<div class="control-group">
					<!--E-mail-->
					<label class="control-label" for="email">E-mail</label>
					<div class="controls">
						<input type="text" id="email" name="email" placeholder="" class="input-xlarge">
						<p class="help-block">Por favor escribe tu correo electr&oacute;nico</p>
					</div>
				<div class="control-group">
		    		<!-- Password-->
		    		<label class="control-label" for="password">Clave</label>
		    		<div class="controls">
		        		<input type="password" id="password" name="password" placeholder="" class="input-xlarge">
		        		<p class="help-block">La clave debe contener al menos 4 caracteres</p>
		      		</div>
		    	</div>

		    	<div class="control-group">
		      		<!-- Button -->
		      		<div class="controls">
		       			<button class="btn btn-success">Registrarse</button>
		      		</div>
				</div>
			</form>
		</fieldset>	
	</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Registro Estudiante</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!--iconos-->
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<body>

<div class="container">
	<div class="container text-center">
		<h1>Bienvenido</h1>
  		<h2>Registro estudiante</h2>
	</div>
</div>
<div class="container-fluid ">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" name="formulario" class="form-horizontal">
		<fieldset>
			<div id="legend">
				<legend >Ingresa los siguientes datos:</legend>
			</div>

			<div class="control-group">
				<!--Nombre-->
				<label class="control-label">Nombre</label>
				
				<div class="controls"><!--salto de linea-->
					<input type="text" id="nombre" name="nombre" placeholder="" class="input-xlarge">
					<p class="help-block">Por favor escribe tu nombre completo</p>
				</div>
			</div>

			<div class="control-group">
				<!--E-mail-->
				<label class="control-label">E-mail</label>
				<div class="controls">
					<input type="text" id="email" name="email" placeholder="" class="input-xlarge">
					<p class="help-block">Por favor escribe tu correo electr&oacute;nico</p>
				</div>
			</div>

			<div class="control-group">
				<!--Documento-->
				<label class="control-label">Documento</label>
				
				<div class="controls"><!--salto de linea con css-->
					<input type="text" id="nombre" name="documento" placeholder="" class="input-xlarge">
					<p class="help-block">Por favor escribe tu n&uacute;mero de identificaci&oacute;n</p>
				</div>
			</div>

			 <div class="control-group">
		      <!-- Password-->
		      <label class="control-label">Clave</label>
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
		</fieldset>

		<?php if(!empty($errores)): ?>
			<div class="error">
				<ul>
					<?php echo $errores;?>
				</ul>
			</div>
		<?php endif; ?>

	</form>
</div>
</body>
</html>
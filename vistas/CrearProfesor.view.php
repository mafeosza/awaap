<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Profesor</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="../css/stars.css">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
	<style type="text/css">
  		.crear{
  			margin-left: 3%;
  			margin-right: 3%;
  			border: 2px solid #DDD7D5;
  			background-color: #FAF8F7;
  		}
  		.fila{
  			margin-left: 3%;
  			margin-right: 3%;
  		}
  		.panel{
  			margin-left: 3%;
  			margin-bottom: 0%;
  		}
  		.control-group, #legend{
  			margin-left: 3%;
  		}
  		input{
  			width: 80%;
  			height: 35px;
  		}
  		textarea{
  			width: 80%;
  		}
  	</style>

</head>

<body>
	<?php require "../vistas/vistasFijas/barraHorizontal.view.php"; ?>
	<div class="container-fluid ">
		<div class="panel">
			
			<h2>Nuevo Profesor</h2>
			<article class="crear">
				<form  name="formulario" method="POST">
					<fieldset>
						<div id="legend">
							<br>
							<legend><b>Ingresa los siguientes datos:</b></legend>
						</div>

						<?php if(!empty($errores)): ?>
							<div class="error">
								<ul>
									<?php echo $errores;?>
								</ul>
							</div>
						<?php endif; ?>

						<div class="row fila">
							<!--Documento-->
							<div class="col-sm-6">
								<div class="control-group">
									<label class="control-label"><h3>Documento</h3></label>
									
									<div class="controls"><!--salto de linea-->
										<input type="text" id="documento" name="documento" placeholder="" class="input-xlarge">
										<p class="help-block">Por favor escribe el documento del profesor</p>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<!--Nombre-->
								<div class="control-group">
									<label class="control-label"><h3>Nombre</h3></label>
									
									<div class="controls"><!--salto de linea-->
										<input type="text" id="nombre" name="nombre" placeholder="" class="input-xlarge">
										<p class="help-block">Por favor escribe el nombre del profesor</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row fila">
							<div class="col-sm-6">
								<!--Correo-->
								<div class="control-group">
									<label class="control-label"><h3>Correo</h3></label>
									
									<div class="controls"><!--salto de linea-->
										<input type="email" id="correo" name="correo" placeholder="" class="input-xlarge">
										<p class="help-block">Por favor escribe el correo del profesor</p>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<!--Clave-->
								<div class="control-group">
									<label class="control-label"><h3>Clave</h3></label>
									
									<div class="controls"><!--salto de linea-->
										<input type="password" id="clave" name="clave" placeholder="" class="input-xlarge">
										<p class="help-block">Por favor escribe la clave del profesor</p>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class = "container-fluid text-center">
							<!-- Button -->
						    <div class="controls">
						    	<button class="btn btn-success">Crear</button>
						    </div>
						</div>							
					</fieldset>
					<br>
				</form>
			</article>
		</div>
	</div>
</body>
</html>
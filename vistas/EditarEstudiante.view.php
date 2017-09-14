<!DOCTYPE html>
<html>
<head>
	<title>Editar Estudiante</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="../css/stars.css">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
	<style type="text/css">
  		.editar{
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
			
			<h2>Editar Estudiante</h2>
			<article class="editar">
				<form  name="formulario" method="POST">
					<fieldset>
						<?php if(!empty($errores)): ?>
							<div class="error">
								<ul>
									<?php echo $errores;?>
								</ul>
							</div>
						<?php endif; ?>
						<div class="row fila">
							<div class="col-sm-6">
								<!--Documento-->
								<div class="control-group">
									<label class="control-label"><h3>Documento</h3></label>
									
									<div class="controls"><!--salto de linea-->
										<input type="text" id="documento" name="documento" value="<?php echo $informacionEstudiante['documento'];?>" class="input-xlarge">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<!--Nombre-->
								<div class="control-group">
									<label class="control-label"><h3>Nombre</h3></label>
									
									<div class="controls"><!--salto de linea-->
										<input type="text" id="nombre" name="nombre" value="<?php echo $informacionEstudiante['nombre'];?>" class="input-xlarge">
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
										<input type="email" id="correo" name="correo" value="<?php echo $informacionEstudiante['correo'];?>" class="input-xlarge">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<!--Clave-->
								<div class="control-group">
									<label class="control-label"><h3>Nueva clave</h3></label>
									
									<div class="controls"><!--salto de linea-->
										<input type="password" id="clave" name="clave" placeholder="" class="input-xlarge">
										<p class="help-block">Si desea cambiar la clave escriba aqu&iacute; la nueva clave, de lo contrario deje este campo vacio</p>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class = "container-fluid text-center">
							<!-- Button -->
						    <div class="controls">
						    	<button class="btn btn-success">Editar</button>
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
<!DOCTYPE html>
<html>
<head>
	<title>Editar Profesor</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="../css/stars.css">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
  		.row{
  			margin-left: 3%;
  			margin-right: 3%;
  			border: 2px solid #DDD7D5;
  			background-color: #FAF8F7;
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
	<div class="container-fluid text-center">
		<h1>AWA<sup>2</sup>P</h1>	
		<p>Aplicaci&oacute;n Web para Apoyar el Aprendizaje de Programaci&oacute;n</p>
	</div>
	<div class="container-fluid ">
		<div class="panel">
			
			<h2>Editar Profesor</h2>
			<article class="row">
				<form  name="formulario" class = "form-horizontal" method="POST" enctype="multipart/form-data" action="">


					<fieldset>

						<?php if(!empty($errores)): ?>
							<div class="error">
								<ul>
									<?php echo $errores;?>
								</ul>
							</div>
						<?php endif; ?>

						<!--Documento-->
						<div class="control-group">
							<label class="control-label"><h3>Documento</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<input type="text" id="documento" name="documento" placeholder="" class="input-xlarge">
							</div>
						</div>

						<!--Nombre-->
						<div class="control-group">
							<label class="control-label"><h3>Nombre</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<input type="text" id="nombre" name="nombre" placeholder="" class="input-xlarge">
							</div>
						</div>

						<!--Correo-->
						<div class="control-group">
							<label class="control-label"><h3>Correo</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<input type="email" id="correo" name="correo" placeholder="" class="input-xlarge">
							</div>
						</div>

						<!--Clave-->
						<div class="control-group">
							<label class="control-label"><h3>Nueva clave</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<p class="help-block">Si desea cambiar la clave escriba aqu&iacute; la nueva clave, de lo contrario deje este campo</p>
								<input type="password" id="clave" name="clave" placeholder="" class="input-xlarge">
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
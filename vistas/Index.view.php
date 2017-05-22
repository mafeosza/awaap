<!DOCTYPE html>
<html>
<head>
	<title>AWAAP UQ: Entrar al sitio</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<style type="text/css">
  		body{
			background-image: url("http://localhost/plataforma/imagenes/bloque.jpg");
			-webkit-background-size: cover;
		    -moz-background-size: cover;
		    background-size: cover;
		    -o-background-size: cover;
		    height:100%;
		}
		h1, h2, h3, h4{
			color: #fff;
		}
		#acceder{
			margin-top: 10%;
		}
		#bloqueTitulo{
			margin-top: 20%
		}
		#acceder{
			background-color: rgb(4,4,0); opacity: 0.8;

		}
		
  	</style>
</head>
<body>
	<div class="container-fluid text-center">
		<div class="row content">
			<div class="col-sm-8">
				<div id="bloqueTitulo">
					<h1>AWA<sup>2</sup>P</h1>
					<h1>Aplicaci&oacute;n Web para el Apoyo del Aprendizaje de Programaci&oacute;n</h1>
				</div>
			</div>
			<div id="acceder" class="col-sm-4">
				<!--<div class="form-group">-->
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" name="login" class="form-horizontal">
						<fieldset>
							<div id="legend">
								<legend ><h2>Acceder</h2></legend>
							</div>

								<!--Nombre-->
							<div class="form-group">
								<label class="control-label" for="documento"><h4>Documento</h4></label>
								<div class="controls">
									<input type="text" id="documento" name="documento" placeholder="" class="input-xlarge">
								</div>
							</div>

						      <!-- Password-->
							<div class="form-group">
							    <label class="control-label" for="password"><h4>Clave</h4></label>
								<div class="controls">
							    	<input type="password" id="password" name="password" placeholder="" class="input-xlarge">
							    </div>
						    </div>

						    <div class="form-group">
						      	<!-- Button -->
						    	<div class="controls">
						         	<button class="btn btn-success">Ingresar</button>
						    	</div>
						    </div>
						    
						    <p style="color: white;">
						    	¿No tienes cuenta?
						    	<br>
						    	<a  href="./controladores/RegistroEstudianteControlador.php">Registrate</a>

						    	<?php if(!empty($errores)): ?>
									<div class="error">
										<ul>
											<?php echo $errores;?>
										</ul>
									</div>
								<?php endif; ?>

						    </p>
						</fieldset>
						
					</form>
				<!--</div>-->
			</div>
		</div>
	</div>
	
</body>
</html>
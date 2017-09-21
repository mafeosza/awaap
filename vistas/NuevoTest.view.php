<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Test</title>
	<title>Editar Reto</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
  	<style type="text/css">
  		.nuevo{
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
</head>
<body>
	<?php if($usuario == 'administrador'){
			require "../vistas/vistasFijas/barraHorizontal.view.php";
	?>
			<div style="margin-left: 4%;">
				<h4><i class="fa fa-arrow-left" aria-hidden="true" style="padding: 5px;"></i><a style="color: black;" href="../controladores/AdministradorControlador.php?a=verTestsReto&id=<?php echo $idReto;?>"><u>Regresar a Tests</u></a></h4>
			</div>
	<?php
		}elseif ($usuario == 'profesor') {
			require "../vistas/vistasFijas/navegadorHorizontal.view.php";
	?>
			<div class="container-fluid text-center">
				<h1>AWA<sup>2</sup>P</h1>	
				<p>Aplicaci&oacute;n Web para Apoyar el Aprendizaje de Programaci&oacute;n</p>
			</div>
	<?php
		}
	?>

	<div class="container-fluid ">
		<div class="panel">
			<h2>Agregar Test</h2>
			<article class="row nuevo">
				<form class = "form-horizontal" method="POST" enctype="multipart/form-data" action="">
					<fieldset>
						<?php if(!empty($errores)): ?>
							<div class="error">
								<ul>
									<?php echo $errores;?>
								</ul>
							</div>
						<?php endif; ?>

						<!--Descripcion-->
						<div class="control-group">
							<label class="control-label"><h3>Descripci&oacute;n</h3></label>
								
							<div class="controls"><!--salto de linea-->
								<textarea type="text" id="descripcion" name="descripcion" class="input-xlarge" rows="4"></textarea>
								<p class="help-block">Escribe una descripci&oacute;n corta sobre lo que consiste el test</p>
							</div>
						</div>

						<!--Valores-->
						<div class="control-group">
							<label class="control-label"><h3>Valores</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<textarea type="text" id="valores" name="valores" class="input-xlarge" rows="4"></textarea>
								<p class="help-block">Escribe separado por enter los valores necesarios para la ejecuci&oacute;n del test en el c&oacute;digo</p>
							</div>
						</div>

						<!--Visible-->
						<div class="control-group">
							<label class="control-label"><h3>Visible</h3></label>
								
							<div class="controls"><!--salto de linea-->
								<select id="visible" name="visible">
									<option value="" selected="selected">- Selecciona -</option>
									<option value="1">Si</option>
									<option value="0">No</option>
								</select>
							</div>
							<p class="help-block">Selecciona si deseas que el test pueda o no pueda ser visto por el estudiante</p>
						</div>

						<!--lenguaje-->
						<div class="control-group">
							<label class="control-label"><h3>Lenguaje</h3></label>
								
							<div class="controls"><!--salto de linea-->
								<select id="lenguaje" name="lenguaje">
									<option value="" selected="selected">- Selecciona -</option>
									<option value="python">Python</option>
									<option value="java">Java</option>
								</select>
							</div>
							<p class="help-block">Selecciona para cu&aacute;l lenguaje de programaci&oacute;n se ejecutara este test</p>
						</div>
						<br>
							
						<div class="col-md-12" align="center">
							<div class="col-md-6">
								<div class="controls">
							    		<button name="nuevo" class="btn btn-success">Guardar y Crear Nuevo Test</button>
						  	 	</div>	
							</div>
							<div class="col-md-6" align="center">
								<!-- Button -->
							    <div class="controls">
							    	<button name= "gFinalizar" class="btn btn-success">Guardar y Salir</button>
							    </div>
							</div>									
						</div>	
						<div class="col-md-12" align="center">
							<br>
							<div class="controls">
						    	<button name="finalizar" class="btn btn-danger">Salir</button>
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
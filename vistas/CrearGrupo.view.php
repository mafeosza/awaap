<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Grupo</title>
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
  			width: 43%;
  			height: 35px;
  		}
  	</style>
</head>
<body>
	<?php require "../vistas/vistasFijas/barraHorizontal.view.php"; ?>
	<div class="container-fluid ">
		<div class="panel">			
			<h2>Nuevo Grupo</h2>
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
							<div class="col-sm-6">
								<!--Numero-->
								<div class="control-group">
									<label class="control-label"><h3>N&uacute;mero</h3></label>
									
									<div class="controls"><!--salto de linea-->
										<input type="text" id="numero" name="numero" placeholder="" class="input-xlarge">
										<p class="help-block">Por favor escribe el n&uacute;mero del grupo</p>
									</div>
								</div>	
								<!--Espacio Academico-->
								<div class="control-group">
									<label for= "espacioAcademico" class="control-label"><h3>Espacio Acad&eacute;mico</h3></label>
									<div class="controls"><!--salto de linea-->
										<select id="espacioAcademico" name="espacioAcademico">
											<option value="Seleccione" selected="selected">-Seleccione-</option>
											<?php foreach ($espacios as $espacio): ?>

												<option value="<?php echo $espacio['id']; ?>"><?php echo $espacio['nombre']; ?></option>

											<?php endforeach; ?>
										</select>
										<p class="help-block">Por favor seleccione el espacio acad&eacute;mico al que pertenece grupo</p>
									</div>
								</div>
								
							</div>
							<div class="col-sm-6">
								<!--Franja-->
								<div class="control-group">
									<label for= "franja" class="control-label"><h3>Franja</h3></label>
									<div class="controls"><!--salto de linea-->
										<select id="franja" name="franja">
											<option value="Seleccione" selected="selected">-Seleccione-</option>
											<option value="D">Diurna</option>
											<option value="N">Nocturna</option>
										</select>
										<p class="help-block">Por favor seleccione la jornada a la que pertenece grupo</p>
									</div>
								</div>

								<!--Profesor-->
								<div class="control-group">
									<label for= "profesor" class="control-label"><h3>Profesor</h3></label>
									<div class="controls"><!--salto de linea-->
										<select id="profesor" name="profesor">
											<option value="Seleccione" selected="selected">-Seleccione-</option>
											<?php foreach($profesores as $infoProfesor): ?>
												
												<option value="<?php echo $infoProfesor['id']; ?>"><?php echo $infoProfesor['nombre']; ?></option>
											<?php endforeach; ?>
										</select>
										<p class="help-block">Por favor seleccione el profesor asignado al grupo</p>
									</div>
								</div>
							</div>
						</div>
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
<!DOCTYPE html>
<html>
<head>
	<title>Editar Grupo</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="../css/stars.css">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
  		.crear{
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
  			width: 30%;
  			height: 35px;
  		}
  	</style>
</head>
<body>
	<div class="container-fluid ">
		<div class="panel">
			
			<h2>Editar Grupo</h2>
			<article class="crear">
				<form  name="formulario" class = "form-horizontal" method="POST" action="">
					<fieldset>
						
						<?php if(!empty($errores)): ?>
							<div class="error">
								<ul>
									<?php echo $errores;?>
								</ul>
							</div>
						<?php endif; ?>

						<!--Numero-->
						<div class="control-group">
							<label class="control-label"><h3>N&uacute;mero</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<input type="text" id="numero" name="numero" placeholder="" class="input-xlarge">								
							</div>
						</div>	

						<!--Franja-->
						<div class="control-group">
							<label for= "franja" class="control-label"><h3>Franja</h3></label>
							<div class="controls"><!--salto de linea-->
								<select id="franja" name="franja">
									<option value="Seleccione" selected="selected">-Seleccione-</option>
									<option value="D">Diurna</option>
									<option value="N">Nocturna</option>
								</select>
							</div>
						</div>

						<!--Espacio Academico-->
						<div class="control-group">
							<label for= "espacioAcademico" class="control-label"><h3>Espacio Acad&eacute;mico</h3></label>
							<div class="controls"><!--salto de linea-->
								<select id="espacioAcademico" name="espacioAcademico">
									<option value="Seleccione" selected="selected">-Seleccione-</option>
									<?php for ($i=1; $i <=10; $i++): ?>
										
										<option value="semestre-<?php echo $i; ?>">Semestre-<?php echo $i; ?></option>
									<?php endfor; ?>
								</select>
							</div>
						</div>

						<!--Profesor-->
						<div class="control-group">
							<label for= "profesor" class="control-label"><h3>Profesor</h3></label>
							<div class="controls"><!--salto de linea-->
								<select id="profesor" name="profesor">
									<option value="Seleccione" selected="selected">-Seleccione-</option>
									<?php for ($i=1; $i <=10; $i++): ?>
										
										<option value="semestre-<?php echo $i; ?>">Semestre-<?php echo $i; ?></option>
									<?php endfor; ?>
								</select>
							</div>
						</div>

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
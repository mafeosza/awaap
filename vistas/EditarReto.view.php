<!DOCTYPE html>
<html>
<head>
	<title>Editar Reto</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<!--navegador-->
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
	      		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        		<span class="icon-bar"></span>
	        		<span class="icon-bar"></span>
	        		<span class="icon-bar"></span>
	     		</button>
	    	</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="../controladores/InicioProfesor.php">Inicio</a></li>
					<li><a href="../controladores/PanelControl.php?id=<?php echo $idGrupo;?>">Panel de Control</a></li>
					<li class="active"><a href="#Nuevo">Nuevo Reto</a></li>	
					<li><a href="../controladores/ProgresoProfesor.php">Progreso Estudiantes</a></li>
					<li><a href="../controladores/Raquin.php">Raquin puntajes</a></li>
		  		</ul>
		  		<ul class="nav navbar-nav navbar-right">
	       			<li><a href="../controladores/Cerrar.php"><span class="glyphicon glyphicon-log-out"></span>Cerrar Sesi&oacute;n</a></li>
	      		</ul>
	      	</div>
		</div>
	</nav>

	<div class="container-fluid text-center">
		<h1>AWA<sup>2</sup>P</h1>	
		<p>Aplicaci&oacute;n Web para Apoyar el Aprendizaje de Programaci&oacute;n</p>
	</div>

	<div class="container-fluid ">
		<div class="panel">
			
			<h2>Modificar Reto</h2>
			<article class="row">
				<form class = "form-horizontal" method="POST" enctype="multipart/form-data" action="">
					<fieldset>
					
						<?php if(!empty($errores)): ?>
							<div class="error">
								<ul>
									<?php echo $errores;?>
								</ul>
							</div>
						<?php endif; ?>

						<!--Titulo-->
						<div class="control-group">
							<label class="control-label"><h3>Titulo</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<input type="text" id="titulo" name="titulo" value="<?php echo $infoReto[0]['titulo']; ?>" class="input-xlarge">
							</div>
						</div>
						
						<!--Descripcion-->
						<div class="control-group">
							<label class="control-label"><h3>Descripci&oacute;n</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<textarea type="text" id="descripcionCorta" name="descripcionCorta" class="input-xlarge" rows="4"><?php echo $infoReto[0]['descripcionCorta']; ?></textarea>
							</div>
						</div>

						<!--Especificaciones-->
						<div class="control-group">
							<label class="control-label"><h3>Especificaicones</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<textarea type="text" id="especificaciones" name="especificaciones" class="input-xlarge" rows="6"><?php echo $infoReto[0]['especificaciones']; ?></textarea>
							</div>
						</div>

						<!--Nivel Dificultad-->
						<div class="control-group">
							<label for= "nivelDificultad" class="control-label"><h3>Nivel Dificultad</h3></label>
							<div class="controls"><!--salto de linea-->
								<select id="nivelDificultad" name="nivelDificultad">
									<option value="Seleccione" selected="selected">Seleccione</option>
									<?php for ($i=1; $i <=5; $i++): ?>
											
										<?php if($infoReto[0]['nivelDificultad'] == $i)
											{
										?>
												<option value="<?php echo $i; ?>" selected="selected">Nivel-<?php echo $i; ?></option>
										<?php
											}else{
										?>
												<option value="<?php echo $i; ?>">Nivel-<?php echo $i; ?></option>
										<?php
											}
										?>
									<?php endfor; ?>
								</select>
							</div>
							<p class="help-block">La dificultad en la que se clasifica este reto, siendo 5 el nivel m&aacute;s complejo y el valor m&aacute;ximo que puede tener</p>
						</div>

						<!--Solución java-->
						<div class="control-group">
							<label class="control-label"><h3>Soluci&oacute;n Java</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<textarea type="text" id="solucionJava" name="solucionJava" class="input-xlarge" rows="8"><?php echo $infoReto[0]['solucionJava']; ?></textarea>
							</div>
						</div>

						<!--Solución python-->
						<div class="control-group">
							<label class="control-label"><h3>Soluci&oacute;n Python</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<textarea type="text" id="solucionPython" name="solucionPython" class="input-xlarge" rows="8"><?php echo $infoReto[0]['solucionPython']; ?></textarea>
							</div>
						</div>

						<input type="hidden" name="temaGuardado" value="<?php echo $infoReto[0]['Tema_id']; ?>">
						<!--Tema-->
						<div class="control-group">
							<label for= "tema" class="control-label"><h3>Tema</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<!--<label for="tema">Temas</label>-->
								<select id="tema" name="tema">
									<?php foreach( $temas as $tema): ?>
										<?php if($tema['id'] == $infoReto[0]['Tema_id'])
												{
											?>
													<option value="<?php echo $tema['id']; ?>" selected="selected"><?php echo $tema['nombre']; ?></option>
										<?php
												}else{
										?>
													<option value="<?php echo $tema['id']; ?>"><?php echo $tema['nombre']; ?></option>
										<?php
												}
										?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<!--Imagen-->
						<div class="control-group">
							<label class="control-label"><h3>Imagen</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<input type="file" id="imagen" name="imagen" placeholder="" class="input-xlarge">
							</div>
						</div>
						<input type="hidden" name="imagenGuardada" value="<?php echo $infoReto[0]['imagen']; ?>">

						<div class = "container-fluid text-center">
							<!-- Button -->
						    <div class="controls">
						    	<button class="btn btn-success">Modificar</button>
						    </div>
						</div>
															
					</fieldset>
				</form>
			</article>
		</div>
	</div>

</body>
</html>
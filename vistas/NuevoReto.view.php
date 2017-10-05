<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Reto</title>
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
	<?php if($usuario == 'administrador'){
			require "../vistas/vistasFijas/barraHorizontal.view.php";
	?>
		<div style="margin-left: 4%;">
			<h4><i class="fa fa-arrow-left" aria-hidden="true" style="padding: 5px;"></i><a style="color: black;" href="../controladores/AdministradorControlador.php?a=verRetos"><u>Regresar a Retos</u></a></h4>
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
			
			<h2>Nuevo Reto</h2>
			<article class="crear">
				<form  name="formulario" class = "form-horizontal" method="POST" enctype="multipart/form-data" action="">


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

						<!--Titulo-->
						<div class="control-group">
							<label class="control-label"><h3>Titulo</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<input type="text" id="titulo" name="titulo" placeholder="" class="input-xlarge">
								<p class="help-block">Por favor escribe el titulo del reto</p>
							</div>
						</div>
						
						<!--Descripcion-->
						<div class="control-group">
							<label class="control-label"><h3>Descripci&oacute;n</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<textarea type="text" id="descripcionCorta" name="descripcionCorta" placeholder="" class="input-xlarge" rows="4"></textarea>
								<p class="help-block">Escribe una descripci&oacute;n corta del reto</p>
							</div>
						</div>

						<!--Especificaciones-->
						<div class="control-group">
							<label class="control-label"><h3>Especificaicones</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<textarea type="text" id="especificaciones" name="especificaciones" placeholder="" class="input-xlarge" rows="6"></textarea>
								<p class="help-block">Escribe una descripci&oacute;n m&aacute;s espec&iacute;fica del reto</p>
							</div>
						</div>
						
							
						
						<!--Nivel Dificultad-->
						<div class="control-group">
							<label class="control-label"><h3>Nivel Dificultad</h3></label>
							<div id="ratingsForm">
							    <div class="stars">
							        <input type="radio" name="star" class="star-1" id="star-1" value="1" />
							        <label class="star-1" for="star-1">1</label>
							        <input type="radio" name="star" class="star-2" id="star-2" value="2" />
							        <label class="star-2" for="star-2">2</label>
							        <input type="radio" name="star" class="star-3" id="star-3" value="3"/>
							        <label class="star-3" for="star-3">3</label>
							        <input type="radio" name="star" class="star-4" id="star-4" value="4"/>
							        <label class="star-4" for="star-4">4</label>
							        <input type="radio" name="star" class="star-5" id="star-5" value="5"/>
							        <label class="star-5" for="star-5">5</label>
							        <span></span>
							    </div>
							</div>
							<p class="help-block">La dificultad en la que se clasifica este reto, siendo 5 el nivel m&aacute;s complejo</p>
						</div>

						
						<!--Solución java-->
						<div class="control-group">
							<label class="control-label"><h3>Soluci&oacute;n Java</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<textarea type="text" id="solucionJava" name="solucionJava" placeholder="" class="input-xlarge" rows="8"></textarea>
								<p class="help-block">Escribe el c&oacute;digo Java que soluciona el reto</p>
							</div>
						</div>

						<!--Solución python-->
						<div class="control-group">
							<label class="control-label"><h3>Soluci&oacute;n Python</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<textarea type="text" id="solucionPython" name="solucionPython" placeholder="" class="input-xlarge" rows="8"></textarea>
								<p class="help-block">Escribe el c&oacute;digo Python que soluciona el reto</p>
							</div>
						</div>

						<!--Tema-->
						<div class="control-group">
							<label for= "tema" class="control-label"><h3>Tema</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<!--<label for="tema">Temas</label>-->
								<select id="tema" name="tema">
									<option value="" selected="selected">- Selecciona -</option>
									<?php foreach( $temas as $tema): ?>
										<option value="<?php echo $tema['id']; ?>"><?php echo $tema['nombre']; ?></option>
									<?php endforeach; ?>
								</select>
								<p class="help-block">Indica el cu&aacute;l es tema al que pertenece de este reto</p>
							</div>
						</div>

						<!--Imagen-->
						<div class="control-group">
							<label class="control-label"><h3>Imagen</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<input type="file" id="imagen" name="imagen" placeholder="" class="input-xlarge">
								<p class="help-block">Selecciona una imagen para el reto</p>
							</div>
						</div>
						<br>
						<div class = "container-fluid text-center">
							<!-- Button -->
						    <div class="controls">
						    	<button class="btn btn-success">Siguiente</button>
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
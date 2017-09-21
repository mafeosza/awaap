<!DOCTYPE html>
<html>
<head>
	<title>Editar Test</title>
	<title>Editar Reto</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
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
		  }elseif ($usuario == 'profesor') {
			require "../vistas/vistasFijas/navegadorHorizontal.view.php";
		  }
	?>

	<div class="container-fluid text-center">
		<h1>AWA<sup>2</sup>P</h1>	
		<p>Aplicaci&oacute;n Web para Apoyar el Aprendizaje de Programaci&oacute;n</p>
	</div>

	<div class="container-fluid ">
		<div class="panel">
			<h2>Modificar Test</h2>
			<article class="row editar">
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
								<textarea type="text" id="descripcion" name="descripcion" class="input-xlarge" rows="4"><?php echo $infoTest[0]['descripcion']; ?></textarea>
							</div>
						</div>

						<!--Valores-->
						<div class="control-group">
							<label class="control-label"><h3>Valores</h3></label>
								
							<div class="controls"><!--salto de linea-->
								<textarea type="text" id="valores" name="valores" class="input-xlarge" rows="4"><?php echo $infoTest[0]['valores']; ?></textarea>
							</div>
						</div>

						<!--Visible-->
						<div class="control-group">
							<label class="control-label"><h3>Visible</h3></label>
							
							<div class="controls"><!--salto de linea-->
								<select id="visible" name="visible">
									<?php 
										if($infoTest[0]['visible']==1)
										{
									?>
											<option value="1" selected="selected">Si</option>
											<option value="0">No</option>
									<?php 
										}else{
									?>
											<option value="0" selected="selected">No</option>
											<option value="1">Si</option>
									<?php 
										}
									?>
								</select>
							</div>
						</div>

						<!--lenguaje-->
						<div class="control-group">
							<label class="control-label"><h3>Lenguaje</h3></label>
								
							<div class="controls"><!--salto de linea-->
								<select id="lenguaje" name="lenguaje">
									<?php 
										if($infoTest[0]['lenguaje']=="python")
										{
									?>
											<option value="python" selected="selected">Python</option>
											<option value="java">Java</option>
									<?php 
										}else{
									?>
											<option value="java" selected="selected">Java</option>
											<option value="python">Python</option>
									<?php 
										}
									?>
								</select>
							</div>
						</div>

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
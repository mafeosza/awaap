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
  			width: 43%;
  			height: 35px;
  		}
  	</style>
</head>
<body>
	<?php require "../vistas/vistasFijas/barraHorizontal.view.php"; ?>
	<div class="container-fluid ">
		<div class="panel">			
			<h2>Editar Grupo</h2>
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
								<!--Numero-->
								<div class="control-group">
									<label class="control-label"><h3>N&uacute;mero</h3></label>
									
									<div class="controls"><!--salto de linea-->
										<input type="text" id="numero" name="numero" value="<?php echo $informacionGrupo['numero'];?>" class="input-xlarge">								
									</div>
								</div>	

								<!--Espacio Academico-->
								<div class="control-group">
									<label for= "espacioAcademico" class="control-label"><h3>Espacio Acad&eacute;mico</h3></label>
									<div class="controls"><!--salto de linea-->
										<select id="espacioAcademico" name="espacioAcademico">
											<?php foreach ($espacios as $espacio): ?>
												<?php if($espacio['id'] == $informacionGrupo['EspacioAcademico_id']){
												?>
													<option value="<?php echo $espacio['id']; ?>" selected="selected"><?php echo $espacio['nombre']; ?></option>
												<?php }else{
												?>
													<option value="<?php echo $espacio['id']; ?>"><?php echo $espacio['nombre']; ?></option>
												<?php } ?>
											<?php endforeach; ?>
										</select>
									</div>
								</div>								
							</div>
							<div class="col-sm-6">
								<!--Franja-->
								<div class="control-group">
									<label for= "franja" class="control-label"><h3>Franja</h3></label>
									<div class="controls"><!--salto de linea-->
										<select id="franja" name="franja">
											<?php if($informacionGrupo['franja'] == "D"){
											?>
												<option value="D" selected="selected">Diurna</option>
												<option value="N">Nocturna</option>
											<?php }else{
											?>
												<option value="D">Diurna</option>
												<option value="N" selected="selected">Nocturna</option>
											<?php } ?>
										</select>
									</div>
								</div>								

								<!--Profesor-->
								<div class="control-group">
									<label for= "profesor" class="control-label"><h3>Profesor</h3></label>
									<div class="controls"><!--salto de linea-->
										<select id="profesor" name="profesor">
											<?php foreach ($profesores as $infoProfesor): ?>
												<?php if($infoProfesor['id'] == $informacionGrupo['Profesor_id']){
												?>
													<option value="<?php echo $infoProfesor['id']; ?>" selected="selected"><?php echo $infoProfesor['nombre']; ?></option>
												<?php }else{
												?>
													<option value="<?php echo $infoProfesor['id']; ?>"><?php echo $infoProfesor['nombre']; ?></option>
												<?php } ?>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
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
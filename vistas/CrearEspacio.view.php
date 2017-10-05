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
  		.chosen1{
  			width: 90%;
  		}
  		input{
  			width: 90%;
  			height: 35px;
  		}
  	</style>
  	<link rel="stylesheet" href="../js/chosen_v1.8.2/chosen.css" type="text/css" />
    <script src="../js/chosen_v1.8.2/chosen.jquery.js"></script>
  	 <script>
    	jQuery(document).ready(function(){
		    jQuery.getScript( "//harvesthq.github.io/chosen/chosen.jquery.js" )
		        .done(function( script, textStatus ) {
		            jQuery(".chosen1").chosen();
		            $("chosen2").chosen({width: "inherit"});
		        })
		        .fail(function( jqxhr, settings, exception ) {
		             alert("Error");
		    });
		  
		});
    </script>
</head>
<body>
	<?php require "../vistas/vistasFijas/barraHorizontal.view.php"; ?>
	<div class="container-fluid ">
		<div class="panel">
			
			<h2>Nuevo Espacio Acad&eacute;mico</h2>
			<article class="crear">
				<form  name="formulario" method="POST" action="">
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
								<!--Nombre-->
								<div class="control-group">
									<label class="control-label"><h3>Nombre</h3></label>
									
									<div class="controls"><!--salto de linea-->
										<input type="text" id="nombre" name="nombre" placeholder="" class="input-xlarge">
										<p class="help-block">Por favor escribe el nombre del espacio acad&eacute;mico</p>
									</div>
								</div>	
							</div>
							<div class="col-sm-6">
								<!--Semestre-->
								<div class="control-group">
									<label for= "semestre" class="control-label"><h3>Semestre</h3></label>
									<div class="controls"><!--salto de linea-->
										<select id="semestre" name="semestre" class="chosen1" data-placeholder="Elige un semestre">
											<option value="" selected="selected">Seleccione</option>
											<?php for ($i=1; $i <=11; $i++): ?>
												
												<option value="<?php echo $i; ?>">Semestre-<?php echo $i; ?></option>
											<?php endfor; ?>
										</select>
										<p class="help-block">Por favor seleccione el semestre al que pertenece el espacio acad&eacute;mico</p>
									</div>
								</div>
							</div>
						</div>
						<!--div class="row fila">
							<div class="col-sm-6"-->
								<!--Unidades-->
								<!--div class="control-group">
									<label class="control-label"><h3>N&uacute;mero de Unidades</h3></label>
									
									<div class="controls">
										<input type="text" id="unidades" name="unidades" placeholder="" class="input-xlarge">
										<p class="help-block">Por favor escribe el n&uacute;mero de unidades del espacio acad&eacute;mico</p>
									</div>
								</div>	
							</div>
						</div-->
							<br>
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
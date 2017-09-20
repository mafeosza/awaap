<!DOCTYPE html>
<html>
<head>
	<title>Retos</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="../css/stars.css">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
	<style type="text/css">
  		.fila{
  			margin-left: 3%;
  			margin-right: 3%;
  		}
  		.panel{
  			margin-left: 3%;
  			margin-right: 3% !important;
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
		.fa-times{
			font-size:24px;
			color: red;
		}
		.buscador{
			width: 80%;
			margin: 1em auto;
			padding: 1em 5%;
			background: #fff;
		}
		#iconMas{
			height: 5%;
  			width: 5%;
		}
		select {
		  	width: 90%;
		}
		.chosen-container {
		 	width: 250px;
		}
  	</style>
  	<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();   
		});
	</script>
	<link rel="stylesheet" href="../js/chosen_v1.8.2/chosen.css" type="text/css" />
    <script src="../js/chosen_v1.8.2/chosen.jquery.js"></script>
    <script>
    	jQuery(document).ready(function(){
		    jQuery.getScript( "//harvesthq.github.io/chosen/chosen.jquery.js" )
		        .done(function( script, textStatus ) {
		            jQuery(".chosen1").chosen();
		        })
		        .fail(function( jqxhr, settings, exception ) {
		             alert("Error");
		    });
		  
		});
    </script>
</head>
<body>
	<?php require "../vistas/vistasFijas/barraHorizontal.view.php"; ?>
	<form  name="formulario" method="POST" action="">
		<div class="container buscador">
			<div class="col-sm-10">
				<h3>Seleccione:</h3>
				<select name="chosen-unique" class="chosen1" data-placeholder="Elige un profesor">
					<option value=""></option>
					<?php echo $profesoresOpcion;?>
				</select>
			</div>
			<div class="col-sm-2" style="margin-top: 6%;">
				<!-- Button -->
				<div class="controls">
					<button class="btn btn-success">Buscar Retos</button>
				</div>
			</div>
			<?php if(!empty($errores)):?>
				<p><?php echo $errores; ?></p>
			<?php endif; ?>
		</div>
	</form>
	<?php if($esSeleccionProfesor and empty($errores)):?>
		<div class="container-fluid ">
			<div class="panel">
				<h2>Retos del profesor: <?php echo $nombreProfesor;?></h2>
				<div class="retos" id="retos" style="">
			       	<table class="table table-bordered">
			       		<thead>
			       			<tr>
			       				<th>Espacio acad&eacute;mico</th>
			       				<th>Tema</th>
			       				<th>Grupo</th>
								<th>Titulo</th>
								<th>Lenguajes</th>
								<th style="text-align: center;">Acci&oacute;n</th>
			       			</tr>
			       		</thead>
			       		<tbody>
			       			<?php echo $tablaRetos; ?>
			       		</tbody>
			       	</table>
			       	<?php if($tablaRetos==""):?>
			       		<div style="text-align: center;">
			       			<h3>No hay retos disponibles</h3>
			       		</div>
			       	<?php endif; ?>
			       	<div style="text-align: right;">
		        		<a data-toggle="tooltip" title="Agregar nuevo" href="../controladores/AdministradorControlador.php?a=crearEspacio"><img id="iconMas" src="../imagenes/plus.png"></a>
		        	</div>
			    </div>
			</div>
		</div>
	<?php endif;?>
</body>
</html>
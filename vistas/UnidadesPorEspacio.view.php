<!DOCTYPE html>
<html>
<head>
	<title>Unidades-Temas</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="../css/stars.css">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
	<style type="text/css">
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
		.fa { margin-right:10px; }
		.fa-trash-o{
			font-size:24px;
			color: red;
		}
		.fa-pencil{
			font-size:24px;
			color: yellow;
		}
		.fa-list-ul{
			font-size:24px;
			color: orange;	
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
		            jQuery(".chosen2").chosen();
		            $("chosen2").chosen({width: "inherit"});
		            $("chosen2").trigger("chosen:updated");
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
				<select name="chosen-unique" class="chosen1" data-placeholder="Elige un espacio acad&eacute;mico">
					<option value=""></option>
					<?php echo $espaciosOpcion;?>
				</select>
			</div>
			<div class="col-sm-2" style="margin-top: 6%;">
				<!-- Button -->
				<div class="controls">
					<button class="btn btn-success">Buscar</button>
				</div>
			</div>
			<?php if(!empty($errores)):?>
				<p><?php echo $errores; ?></p>
			<?php endif; ?>
		</div>
	</form>
	<?php if($esSeleccionEspacio and empty($errores)):?>
		<div class="container-fluid ">
			<div class="panel">
				<h2>Unidades y Temas del Espacio Acad&eacute;mico: <?php echo $nombreEspacio;?></h2>
				<div class="unidades" id="unidades">
			       	<table class="table table-bordered">
			       		<thead>
			       			<tr>
			       				<th>Id</th>
			       				<th>N&uacute;mero</th>
								<th style="text-align: center;">Acci&oacute;n</th>
			       			</tr>
			       		</thead>
			       		<tbody>
			       			<?php echo $tablaUnidades; ?>
			       		</tbody>
			       	</table>
			       	<?php if($tablaUnidades==""):?>
			       		<div style="text-align: center;">
			       			<h3>No hay unidades disponibles</h3>
			       		</div>
			       	<?php endif; ?>
			       	<div style="text-align: right;">
		        		<a data-toggle="tooltip" title="Agregar nuevo" href="../controladores/UnidadControlador.php?a=nuevo&id=<?php echo $idEspacioAcademico;?>"><img id="iconMas" src="../imagenes/plus.png"></a>
		        	</div>
			    </div>
			</div>
		</div>
	<?php endif;?>

	<div class="modal fade" id="seleccionGrupo" tabindex="-1" role="dialog" area-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3>Seleccione el grupo al que se le crear&aacute; el reto:</h3>
				</div>
				<div class="modal-body">
					<form name="formularioModal" method="POST" action="">
						<!--select name="chosen-unique2" class="chosen2" data-placeholder="Elige un grupo"-->
						<select name="chosen-unique2" id="chosen2" data-placeholder="Elige un grupo">
							<option value=""></option>
							<?php echo $opcionesGrupos;?>
						</select>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-info" name="continuar" id="continuar">Continuar</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
	$("#continuar").click(function(){
		var grupo = $("#chosen2").val();
		console.log(grupo);
		window.location.href = '../controladores/RetoControlador.php?a=nuevo&id='+grupo;
	});
</script>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Registrar Estudiante</title>
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

  	</style>
  	<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();   
		});
	</script>
</head>
<body>
	<?php require "../vistas/vistasFijas/barraHorizontal.view.php"; ?>
	<div class="container-fluid ">
		<div class="panel">
			<h2>Estudiantes registrados en el grupo: </h2>
			<div class="estudiantes" id="estudiantes" style="">
		       	<table class="table table-bordered">
		       		<thead>
		       			<tr>
		       				<th>ID</th>
		       				<th>Documento</th>
							<th>Nombre</th>
							<th style="text-align: center;">Acci&oacute;n</th>
		       			</tr>
		       		</thead>
		       		<tbody>
		       			<?php echo $tablaEstudiantes; ?>
		       		</tbody>
		       	</table>
		       	<?php if($tablaEstudiantes==""):?>
		       		<div style="text-align: center;">
		       			<h3>No hay estudiantes registrados en este grupo</h3>
		       		</div>
		       	<?php endif; ?>
		    </div>
		</div>
	</div>
</body>
</html>
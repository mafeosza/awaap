<!DOCTYPE html>
<html>
<head>
	<title>Lista Tests</title>
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
</head>
<body>
	<?php require "../vistas/vistasFijas/barraHorizontal.view.php";?>
	<div style="margin-left: 4%;">
		<h4><i class="fa fa-arrow-left" aria-hidden="true" style="padding: 5px;"></i><a style="color: black;" href="../controladores/AdministradorControlador.php?a=verRetos"><u>Regrsar a Retos</u></a></h4>
	</div>
	<div class="container-fluid ">
			<div class="panel">
				<h2>Test del Reto: <?php echo $tituloReto;?></h2>
				<div class="retos" id="retos" style="">
			       	<table class="table table-bordered">
			       		<thead>
			       			<tr>
			       				<th>Descripci&oacute;n</th>
			       				<th>Valores</th>
			       				<th>Visibilidad</th>
								<th>Lenguaje</th>
								<th style="text-align: center;">Acci&oacute;n</th>
			       			</tr>
			       		</thead>
			       		<tbody>
			       			<?php echo $tablaTest; ?>
			       		</tbody>
			       	</table>
			       	<?php if($tablaTest==""):?>
			       		<div style="text-align: center;">
			       			<h3>No hay tests disponibles</h3>
			       		</div>
			       	<?php endif; ?>
			       	<div style="text-align: right;">
		        		<a data-toggle="tooltip" title="Agregar nuevo" href="../controladores/AdministradorControlador.php?a=crearEspacio"><img id="iconMas" src="../imagenes/plus.png"></a>
		        	</div>
			    </div>
			</div>
		</div>
</body>
</html>
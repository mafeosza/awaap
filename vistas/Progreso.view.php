<!DOCTYPE html>
<html>
<head>
	<title>Mi Progreso</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<style type="text/css">
  		.row{
  			margin-left: 10%;
  			margin-right: 10%;
  			border: 2px solid #DDD7D5;
  			background-color: #FAF8F7;
  		}
  		.panel{
  			margin-left: 10%;
  			margin-bottom: 0%;
  		}

  		.tituloHeader{
  			margin-left: 3%;
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
					<li><a href="../controladores/InicioEstudiante.php">Inicio</a></li>
						
					<li class="active"><a href="../controladores/Progreso.php">Mi Progreso</a></li>
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
			<h2>Resumen de progreso</h2>
		</div>
		<article class="row">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre Del Reto</th>
						<th>Espacio Acad&eacute;mico</th>
						<th>N&uacute;mero Intentos</th>
						<th>Lenguaje</th>
						<th>Fecha &Uacute;ltimo Intento</th>
						<th>Puntaje</th>
						<th>Aprobado</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($informacionEstudiante as $infoEstudiante) 
						{	
							if ($infoEstudiante['superado'] == 1) {
					?>

							<tr class="success">
								<td><?php echo $conteoRetos; ?></td>
								<td><?php echo $infoEstudiante['titulo']; ?></td>
								<td><?php echo $infoEstudiante['nombre']; ?></td>
								<td><?php echo $infoEstudiante['conteo']; ?></td>
								<td><?php echo $infoEstudiante['lenguaje']; ?></td></td>
								<td><?php echo $infoEstudiante['fecha']; ?></td>
								<td><?php echo $infoEstudiante['puntaje']; ?></td>
								<td><span class= "glyphicon glyphicon-ok"></span></td>
							</tr>
					<?php 
							}elseif ($infoEstudiante['superado'] == 0){
					?>
					<tr class="danger">
						<td><?php echo $conteoRetos; ?></td>
						<td><?php echo $infoEstudiante['titulo']; ?></td>
						<td><?php echo $infoEstudiante['nombre']; ?></td>
						<td><?php echo $infoEstudiante['conteo']; ?></td>
						<td><?php echo $infoEstudiante['lenguaje']; ?></td></td>
						<td><?php echo $infoEstudiante['fecha']; ?></td>
						<td><?php echo $infoEstudiante['puntaje']; ?></td>
						<td><span class="glyphicon glyphicon-remove"></span></td>
					</tr>
					<?php
							}
						}
					?>
				</tbody>
			</table>
		</article>
	</div>

	
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio Estudiante</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
					<li class="active"><a href="../controladores/InicioEstudiante.php">Inicio</a></li>
						
					<li><a href="../controladores/Progreso.php">Mi Progreso</a></li>
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
		<h2>Bienvenido <?php  echo $nombre;?></h2><br>
	</div>	
	<div class="container-fluid ">
		<div class="row content">
			<div class="col-sm-4">
				<h2>Retos pendientes</h2>
				<?php if(!empty($retosNoCompletados)): ?>
					<p>Estos son los retos que no haz completado en su totalidad</p>
				
					<?php foreach($retosNoCompletados as $retoNoCompletado): ?>
						<a href="../controladores/Reto.php?id=<?php echo $retoNoCompletado['id'];?>"><h4><?php echo $retoNoCompletado['titulo']; ?></h4></a>
						
					<?php endforeach; ?>
				<?php endif; ?>
				<?php if(empty($retosNoCompletados)): ?>
					<h4>No tienes retos sin completar</h4>
				<?php endif; ?>
			</div>
			<div class="col-sm-5">
				<h2 align="left">Tus espacios acad&eacute;micos</h2>

				<?php foreach($espacios as $nombreEspacio): ?>

					<a href="../controladores/EspacioAcademicoControlador.php?id=<?php echo $nombreEspacio['id'];?>"><h4><li><?php echo $nombreEspacio['nombre']; ?></li></h4></a>
					
				<?php endforeach; ?>
			</div>
			<div class="col-sm-3">
				<h2 align="left">Puntajes</h2>
				<a href="../controladores/Progreso.php"><h4><li>Tu progreso</li></h4></a>
				<a href="../controladores/Raquin.php"><h4><li>Mejores puntajes</li></h4></a>
			</div>
			<!--<div class="col-sm-2">
					<h4 align="left">Registrate en un espacio acad&eacute;mico</h4>
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle"
						          data-toggle="dropdown">
						    Espacios Acad&eacute;micos <span class="caret"></span>
						</button>					 
					  	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					  	<?php #foreach($espaciosAcademicos as $espacioAcademico): ?>
					    	<li><a href="#"><?php #echo $espacioAcademico['nombre'];?></a></li>
						<?php #endforeach ?>
					  	</ul>
					</div>
			</div>-->
		</div>
	</div>
</body>
</html>
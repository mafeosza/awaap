<!DOCTYPE html>
<html>
<head>
	<title>Inicio Profesor</title>
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
					<li class="active"><a href="../controladores/InicioProfesor.php">Inicio</a></li>
						
					<li><a href="../controladores/ProgresoProfesor.php">Progreso Estudiantes</a></li>
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

	<div class="container-fluid text-center">
		<div class="row content">	
			<h2 align="center">Tus espacios acad&eacute;micos</h2>
			<div class="col-sm-4">
			</div>
			<div class="col-sm-6" align="left">
				<?php if(!empty($grupos)): ?>
					<?php foreach($grupos as $grupo):?>
						<a href="../controladores/PanelControl.php?id=<?php echo $grupo['id'];?>"><h4><li><?php echo $grupo['numero']." ".$grupo['franja']."- ".$espacioAcademico->nombreEspacioAcademico($grupo['EspacioAcademico_id']);?></li></h4></a>
					<?php endforeach;?>
				<?php endif; ?>
				<?php if(empty($grupos)): ?>
					<h4>No tienes grupos</h4>
				<?php endif; ?>
			</div>
		</div>
	</div>

</body>
</html>
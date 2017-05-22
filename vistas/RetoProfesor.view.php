<!DOCTYPE html>
<html>
<head>
	<title>Reto</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<style type="text/css">
  		.textBarra{
  			float: left;
  		}
  		.aprob{
  			margin-left: 80%;

  		}
  		.progress{
  			clear:both;
  		}
  		.textBarra{
  			margin-left: 1%;
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
      				<li><a href="../controladores/EspacioAcademicoControlador.php?id=<?php echo $espacioAcademico[0]['id'];?>">Temas</a></li>
      				<li><a href="../controladores/TemaControlador.php?id=<?php echo $temaReto[0]['id']; ?>">Lista Retos</a></li>
					<li class="active"><a href="#retos">Reto</a></li>
					<li><a href="../controladores/Progreso.php">Mi Progreso</a></li>
					<li><a href="../controladores/Raquin.php">Raquin puntajes</a></li>
			  	</ul>
			  	<ul class="nav navbar-nav navbar-right">
		      		<li><a href="../controladores/Cerrar.php"><span class="glyphicon glyphicon-log-out"></span>Cerrar Sesi&oacute;n</a>
		      		</li>
		      	</ul>
	      	</div>
		</div>
	</nav>
	
	<div class="container-fluid text-center">	
		<h1>AWA<sup>2</sup>P</h1>	
		<p>Aplicaci&oacute;n Web para Apoyar el Aprendizaje de Programaci&oacute;n</p>
		<h1>Reto <?php echo $nombreReto; ?></h1>
	</div>
	
	<div class="textBarra">
		<h4>Tu progreso en este reto</h4>
	</div>
	

	<div class="progress">
	  <div class="progress-bar" role="progressbar" aria-valuenow="60"
	       aria-valuemin="0" aria-valuemax="100" style="width: 0.5%;">
	  </div>
	</div>

	<div class="container-fluid">
		<h3>Descripci&oacute;n</h3>
		<p><?php echo $datosReto[0]['descripcionCorta']; ?></p>
		
	</div>

	<div class="container-fluid">
		<h3 align="left">Especificaciones</h3>
		<p align="left"><?php echo $datosReto[0]['especificaciones'];?></p>
	</div>

	<div class="container-fluid text-center">
	
		<div class="row content">
			<div class="col-sm-8">
				<form action="#" method="POST" name="compilar">
					<fieldset>
						
						<h4 align="left">Escribe tu c&oacute;digo aqu&iacute;</h4>

						<div class="form-group">
							<textarea class="form-control" rows="8" id="codigo" name="codigo" required></textarea>
						</div>
						
						 <div class="form-group">
						 	<div class="controls">
								<button class="btn btn-success">Enviar</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			

			<div class="col-sm-4">
				<div class="tests" align="left">
					<h3 align="left">Tests</h3>
					<!--<div class="alert alert-success">-->
					<!--<div class="alert alert-danger">-->
						<?php echo $contenidoLi; ?>
					<!--</div>-->
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<!--<?php include_once 'budget_calc.php'; ?>
<script>
$(function() {
$( "#progressbar" ).progressbar({
max: <?php #echo $max_budget_echo; ?>,
value: <?php #echo $total; ?>
});
});
</script>-->
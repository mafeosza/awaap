<!DOCTYPE html>
<html>
<head>
	<title>Espacio academico</title>
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
			 		<li><a href="../controladores/InicioEstudiante.php">Inicio</a></li>
					<li class="active"><a href="#temas">Temas</a></li>
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
	<h2><?php echo $nombre; ?></h2>
</div>
<div class="container-fluid ">
	<div class="row content">
		<div class="col-sm-3">
		<h3>Material de apoyo</h3>
		<?php if(!empty($materiales)): ?>
			<?php foreach($materiales as $material): ?>
				<a href="#<?php echo $material[0]['id']; ?>"><?php echo basename($material['nombre'], '.pdf'); ?></a>

			<?php endforeach;?>

		<?php endif;?>
		<?php if(empty($materiales)):?>
			<h4>No hay material de estudio disponible</h4>
		<?php endif; ?>
		</div>
		
		<div class="col-sm-9">
			
			<hr>
			<div class="container-fluid">
			
				<h3>TEMARIO</h3>
				<div class="row">
					
					<div role="tabpanel">
						<ul class="nav nav-tabs" role="tablist">
							<?php echo $nombreTab; ?>
						</ul>

					<div class="tab-content">
						<?php echo $contenidoTab; ?>
					</div>	
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</body>
</html>
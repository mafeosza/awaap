<!DOCTYPE html>
<html>
<head>
	<title>Panel de control</title>
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

  		.tituloHeader, .descripcion{
  			margin-left: 3%;
  		}
  		.tests{
	  			margin-left: 10%;
  		}
  		.contenedor{
  			margin-left: 55%;
  			margin-top: 2%;
  			margin-bottom: 2%;

  		}
  		img{
  			width: 200px;
  			height: 200px;
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
					<li><a href="../controladores/InicioProfesor.php">Inicio</a></li>
					<li class="active"><a href="#PanelControl">Panel de Control</a></li>	
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
	</div>	

	<div class="container-fluid ">
		<div class="panel">
			
			<h2>Panel de Control</h2>
			<a href="../controladores/RetoControlador.php?a=nuevo&id=<?php echo $id; ?>" class="btn btn-info">Nuevo</a>
		</div>
		<?php 
			if(!empty($infoRetos))
				{
		?>			
				<?php foreach($infoRetos as $infoReto): ?>	
					
					<article class="row">
						<div class="col-sm-4">
							
							<header class="tituloHeader">
								<h2 class="titulo"><b><?php echo $contReto.". ".$infoReto['titulo']; $contReto++; ?></h2>
								<a href="../controladores/RetoControlador.php?a=editar&id=<?php echo $infoReto['id']; ?>">Editar</a>
								<a href="../controladores/Reto.php?id=<?php echo $infoReto['id']; ?>">Ver</a>
								<a href="../controladores/RetoControlador.php?a=borrar&id=<?php echo $infoReto['id']; ?>">Borrar</a>
							</header>
							<div class="descripcion">
								<br />
								<p><b>Descripci&oacute;n:</b></p>
								<p><?php echo $infoReto['descripcionCorta']; ?></p>
							</div>

							<div class="tests">
								<!--<br>-->
								<div class="seccionTests">
									<h3><b><u>Tests</u></h3> <a href="../controladores/TestControlador.php?a=nuevo&id=<?php echo $infoReto['id']; ?>">Agregar Test</a></b>
								</div>
								
								<header>
									<?php 
										if($test->informacionTest($infoReto['id'])){
										$contTest = 1;

									?>
										<?php foreach($test->informacionTest($infoReto['id']) as $infoTest): ?>
											<h4><li><?php echo $contTest.". ".$infoTest['descripcion']; $contTest++;?></li></h4>
											<a href="../controladores/TestControlador.php?a=editar&id=<?php echo $infoTest['id'];?>">Editar</a>
											<a href="../controladores/TestControlador.php?a=borrar&id=<?php echo $infoTest['id'];?>">borrar</a>
										<?php endforeach ?>
									<?php 
								}else{

									?>				
										<h4>No haz creados tests para este reto</h4>
										<p align="center">Haz click en Agregar Reto para crear uno</p>
																			
								<?php
										}
								?>
								
								</header>
							</div>
						</div>

						<div class="col-sm-8">
							<div class="contenedor">
								
									<div class="thumb">
										
											<img src="<?php echo $infoReto['imagen']; ?>">
									
									</div>
								
							</div>	
							
						</div>
							
					</article>
					<br>
				<?php endforeach;?>
				
		<?php
				}else{
		?>
			<article class="row">
				<header class="tituloHeader"> 
					<h2 align="center">No haz creados retos para este grupo</h2>
					<p align="center">Haz click en Nuevo para crear uno</p>
				</header>
			</article>
		<?php
				}
		?>
		</div>
		
	</div>
</body>
</html>
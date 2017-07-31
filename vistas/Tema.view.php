<!DOCTYPE html>
<html>
<head>
	<title>Tema</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  	<link rel="stylesheet" type="text/css" href="../css/main.css">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<style type="text/css">
  		.imgReto{
  			height: 200px;
  			width: 200px;
  		}
  		.logo{
  			height: 70px;
  			width: 20px;
  			border: 2px solid #000;
    		border-radius: 8px;
  		}
  		h4{
  			font-size: 15px;
  			text-align: center;
  		}
  	</style>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<script src="menuPrincipal.js"></script>
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
			 		<li class="active"><a href="../controladores/TemaControlador.php">Lista Retos</a></li>
					<li><a href="../controladores/Progreso.php">Mi Progreso</a></li>
					<li><a href="../controladores/Raquin.php">Raquin puntajes</a></li>
		  		</ul>
		  		<ul class="nav navbar-nav navbar-right">
	       			<li><a href="../controladores/Cerrar.php"><span class="glyphicon glyphicon-log-out"></span>Cerrar Sesi&oacute;n</a></li>
	       		</ul>
	      	</div>
		</div>
	</nav>
	
<p align="center"><script src="menuPrincipal.js"></script>
	<button class="btn btn-default" data-toggle="modal" data-target="#popupNuevaAventura">Crear nueva</button>
</p>
<!-- Modal Escenario-->
<div class="modal fade" id="popupNuevaAventura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="myModalLabel">Creando una nueva aventura</h4>
      </div>
      <div id="nuevaAventura" class="modal-body">
            <form role="form">
              <div class="form-group">
                <label for="nombreAventura">Nombre de la aventura</label>
                <input type="text" class="form-control" id="nombreAventura" placeholder="Reinos de Papel y los dados trucados..." required>
              </div>
              <div class="form-group">
                <label for="tiempoJuego">Tiempo estimado de juego</label>
                <input type="number" class="form-control" id="tiempoJuego" placeholder="7 horas" required>                      
              </div>
              <div class="form-group">
                <label for="nivelJuego">Nivel de los jugadores</label>
                <input type="number" class="form-control" id="nivelJuego"  placeholder="2" required>
              </div>             
           </form>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" id="botonAventura" onClick="alert('Botón crear')">Crear</button>        
      </div>
    </div>
  </div>
</div>

	<div class="container-fluid text-center">	
		<h1>AWA<sup>2</sup>P</h1>	
		<p>Aplicaci&oacute;n Web para Apoyar el Aprendizaje de Programaci&oacute;n</p>
		<h2>Retos con: <?php echo $nombre; ?></h2><br>
	</div>
	<section class="fotos">
		<div class="contenedor">
			<?php 
				if (!empty($retos))
				{
				
			?>
					<?php foreach ($retos as $reto): ?>
						<div class="thumb">
							<!--a href="../controladores/Reto.php?id=<?php #echo $reto['id'];?>"--> <h3 align="center"><b><?php echo $reto['titulo']; ?></b></h3><!--/a-->
							<!--a href="../controladores/Reto.php?id=<?php #echo $reto['id'];?>"-->
								<img class="imgReto" src="<?php echo $reto['imagen']; ?>" alt="<?php echo $reto['id'];?>">
							<!--/a-->
								<h4>Escoje un lenguaje de programaci&oacute;n</h4>
								<h4>para resolver este reto</h4>
							<div class="col-md-12" align="center">
								<?php if (!empty($reto['solucionJava'])) { ?>
									<div class="col-md-6">
										<a href="../controladores/Reto.php?id=<?php echo $reto['id'];?>&l=java">
											<img src="../imagenes/javalogo.png" class="logo">
										</a>
									</div>
								<?php } ?>
								<?php if (!empty($reto['solucionPython'])) { ?>
									<div class="col-md-6">
										<a href="../controladores/Reto.php?id=<?php echo $reto['id'];?>&l=python">
											<img src="../imagenes/pythonlogo.png" class="logo">
										</a>
									</div>
								<?php } ?>
							</div>
						</div>

					<?php endforeach;?>
			<?php
				}else{
			?>
					<div class="container-fluid text-center">
					<h3>No Hay Retos Disponibles</h3>
					</div>
			<?php
				}
			?>

		</div>	
	</section>


</body>
</html>
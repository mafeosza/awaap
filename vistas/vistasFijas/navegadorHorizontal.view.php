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
				<li><a href="../controladores/PanelControl.php?id=<?php echo $idGrupo;?>">Panel de Control</a></li>
				<li class="active"><a href="#Nuevo">Reto</a></li>	
				<li><a href="../controladores/ProgresoProfesor.php">Progreso Estudiantes</a></li>
				<li><a href="../controladores/Raquin.php">Raquin puntajes</a></li>
	  		</ul>
	  		<ul class="nav navbar-nav navbar-right">
       			<li><a href="../controladores/Cerrar.php"><span class="glyphicon glyphicon-log-out"></span>Cerrar Sesi&oacute;n</a></li>
      		</ul>
      	</div>
	</div>
</nav>
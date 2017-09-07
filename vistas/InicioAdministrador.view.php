<!DOCTYPE html>
<html>
<head>
	<title>Inicio Administrador</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  	<style>
		.fa { margin-right:10px; }
		.fa-trash-o{
			font-size:24px;
			color: red;
		}
		.fa-pencil{
			font-size:24px;
			color: yellow;
		}
		.panel-body { padding:0px; }
		.panel-body table tr td { padding-left: 15px }
		.panel-body .table {margin-bottom: 0px; }
		#iconMas{
			height: 5%;
  			width: 5%;
		}
		#iconEditar, #iconEliminar{
			height: 5%;
  			width: 3%;	
		}
  	</style>
  	<script>
  		$(document).on('ready', function(){
	  		$( "#tituloEspacios" ).click(function() {
	  			$("#bienvenido").css("display", "none");
				$("#espaciosAcademicos").show();
				$("#estudiantes").css("display", "none");
				$("#profesores").css("display", "none");
				$("#grupos").css("display", "none");
			});
			$( "#tituloEstudiantes" ).click(function() {
	  			$("#bienvenido").css("display", "none");
				$("#estudiantes").show();
				$("#espaciosAcademicos").css("display", "none")
				$("#profesores").css("display", "none");
				$("#grupos").css("display", "none");
			});
			$( "#tituloProfesores" ).click(function() {
	  			$("#bienvenido").css("display", "none");
				$("#profesores").show();
				$("#espaciosAcademicos").css("display", "none")
				$("#estudiantes").css("display", "none");
				$("#grupos").css("display", "none");
			});
			$( "#tituloGrupos" ).click(function() {
	  			$("#bienvenido").css("display", "none");
				$("#grupos").show();
				$("#espaciosAcademicos").css("display", "none")
				$("#estudiantes").css("display", "none");
				$("#profesores").css("display", "none");
			});
  		})
  	</script>
</head>
<body>
	<div style="text-align: right;">
		<a href="../controladores/Cerrar.php"><span class="glyphicon glyphicon-log-out"></span>Cerrar Sesi&oacute;n</a>
	</div>
	<div class="container-fluid text-center">
		<h1>AWA<sup>2</sup>P</h1>	
		<p>Aplicaci&oacute;n Web para Apoyar el Aprendizaje de Programaci&oacute;n</p>
	</div>	
	<!--Navegador vertical-->
	<div class="container">
	    <div class="row">
	        <div class="col-sm-3 col-md-3">
	            <div class="panel-group" id="accordion">
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        <h4 class="panel-title">
	                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseEspacios" id="tituloEspacios"><i class="fa fa-book" aria-hidden="true"></i>Espacios Acad&eacute;micos</a>
	                        </h4>
	                    </div>
	                    <div id="collapseEspacios" class="panel-collapse collapse">
	                        <div class="panel-body">
	                            <table class="table">
	                                <tr>
	                                    <td>
	                                        <a href="#reoprtePorEspacio">Reportes Por Espacio Acad&eacute;mico</a>
	                                    </td>
	                                </tr>
	                            </table>
	                        </div>
	                    </div>
	                </div>
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        <h4 class="panel-title">
	                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseEstudiantes" id="tituloEstudiantes"><i class="fa fa-user" aria-hidden="true"></i>Estudiantes</a>
	                        </h4>
	                    </div>
	                    <div id="collapseEstudiantes" class="panel-collapse collapse">
	                        <div class="panel-body">
	                            <table class="table">
	                            	<tr>
	                                    <td>
	                                        <a href="#raquin">Mejores Puntajes</a>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <a href="#Progreso">Progreso Individual</a>
	                                    </td>
	                                </tr>
	                            </table>
	                        </div>
	                    </div>
	                </div>
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        <h4 class="panel-title">
	                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseProfesores" id="tituloProfesores"><i class="fa fa-user" aria-hidden="true"></i>Profesores</a>
	                        </h4>
	                    </div>
	                    <div id="collapseProfesores" class="panel-collapse collapse">
	                        <div class="panel-body">
	                            <table class="table">
	                                <tr>
	                                    <td>
	                                        <a href="#retos">Retos</a>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <a href="#gruposPorProfesor">Grupos Profesor</a>
	                                    </td>
	                                </tr>
	                            </table>
	                        </div>
	                    </div>
	                </div>
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        <h4 class="panel-title">
	                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseGrupos" id="tituloGrupos"><i class="fa fa-users"></i>Grupos</a>
	                        </h4>
	                    </div>
	                    <div id="collapseGrupos" class="panel-collapse collapse">
	                        <div class="panel-body">
	                            <table class="table">
	                                <tr>
	                                    <td>
	                                    	<a href="#reportes">Reporte por grupo</a>
	                                    </td>
	                                </tr>
	                            </table>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-9 col-md-9" id="bienvenido">
	            <div class="well">
	                <h1>Bienvenido Administrador</h1>
	                Panel de control
	            </div>
	        </div>
	        <div class="col-sm-9 col-md-9" id="espaciosAcademicos" style="display: none;">
	        	<table class="table table-bordered">
	        		<thead>
	        			<tr>
	        				<th>ID</th>
							<th>Nombre Espacio Acad&eacute;mico</th>
							<th>Semestre</th>
							<th>Acci&oacute;n</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<?php echo $tablaEspaciosAcademicos; ?>
	        		</tbody>
	        	</table>
	        	<?php if($tablaEspaciosAcademicos==""):?>
	        		<div style="text-align: center;">
	        			<h3>No hay elementos</h3>
	        		</div>
	        	<?php endif; ?>
	        	<div style="text-align: right;">
	        		<a href="#agregarEspacios"><img id="iconMas" src="../imagenes/plus.png"></a>
	        	</div>
	        </div>
	        <div class="col-sm-9 col-md-9" id="estudiantes" style="display: none;">
	        	<table class="table">
	        		<thead>
	        			<tr>
	        				<th>ID</th>
	        				<th>Documento</th>
							<th>Nombre</th>
							<th>Correo</th>
							<th>Acci&oacute;n</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<?php echo $tablaEstudiantes; ?>
	        		</tbody>
	        	</table>
	        	<?php if($tablaEstudiantes==""):?>
	        		<div style="text-align: center;">
	        			<h3>No hay elementos</h3>
	        		</div>
	        	<?php endif; ?>
	        	<div style="text-align: right;">
	        		<a href="#agregarEstudiantes"><img id="iconMas" src="../imagenes/plus.png"></a>
	        	</div>
	        </div>
	        <div class="col-sm-9 col-md-9" id="profesores" style="display: none;">
	        	<table class="table">
	        		<thead>
	        			<tr>
	        				<th>ID</th>
	        				<th>Documento</th>
							<th>Nombre</th>
							<th>Correo</th>
							<th>Acci&oacute;n</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<?php echo $tablaProfesores; ?>
	        		</tbody>
	        	</table>
	        	<?php if($tablaProfesores==""):?>
	        		<div style="text-align: center;">
	        			<h3>No hay elementos</h3>
	        		</div>
	        	<?php endif; ?>
	        	<div style="text-align: right;">
	        		<a href="#agregarProfesores"><img id="iconMas" src="../imagenes/plus.png"></a>
	        	</div>
	        </div>
	        <div class="col-sm-9 col-md-9" id="grupos" style="display: none;">
	        	<table class="table">
	        		<thead>
	        			<tr>
	        				<th>ID</th>
	        				<th>N&uacute;mero</th>
	        				<th>Franja</th>
							<th>Profesor</th>
							<th>Espacio Acad&eacute;mico</th>
							<th>Acci&oacute;n</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<?php echo $tablaGrupos; ?>
	        		</tbody>
	        	</table>
	        	<?php if($tablaGrupos==""):?>
	        		<div style="text-align: center;">
	        			<h3>No hay elementos</h3>
	        		</div>
	        	<?php endif; ?>
	        	<div style="text-align: right;">
	        		<a href="#agregarGrupos"><img id="iconMas" src="../imagenes/plus.png"></a>
	        	</div>
	        </div>
	    </div>
	</div>

</body>
</html>
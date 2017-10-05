<!DOCTYPE html>
<html>
<head>
	<title>Reto Nuevo</title>
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
  	<link rel="stylesheet" href="../js/chosen_v1.8.2/chosen.css" type="text/css" />
    <script src="../js/chosen_v1.8.2/chosen.jquery.js"></script>
    <script>
    	jQuery(document).ready(function(){
		    jQuery.getScript( "//harvesthq.github.io/chosen/chosen.jquery.js" )
		        .done(function( script, textStatus ) {
		            jQuery(".chosen1").chosen();
		            jQuery(".chosen2").chosen();
		        })
		        .fail(function( jqxhr, settings, exception ) {
		             alert("Error");
		    });
		  
		});
    </script>
</head>
<body>
	<?php require "../vistas/vistasFijas/barraHorizontal.view.php"; ?>
	<div style="margin-left: 4%;">
		<h4><i class="fa fa-arrow-left" aria-hidden="true" style="padding: 5px;"></i><a style="color: black;" href="../controladores/AdministradorControlador.php?a=verRetos"><u>Regresar a Retos</u></a></h4>
	</div>
	<form  name="formulario" method="POST" action="">
		<div class="container-fluid ">
			<div class="panel">
				<h3>Seleccione el grupo al que se le crear&aacute; el reto:</h3>
				<select name="chosen-unique" class="chosen1" data-placeholder="Elige un grupo">
					<option value=""></option>
					<?php echo $opcionesGrupos;?>
				</select>
			</div>
		</div>
		<div class="container-fluid">
			<div class="panel">
				<h3>Seleccione el tema al que se le crear&aacute; el reto:</h3>
				<select name="chosen-unique2" class="chosen2" data-placeholder="Elige un tema">
					<option value=""></option>
					<?php echo $opcionesTema;?>
				</select>
			</div>
		</div>
		<br>
		<div class = "container-fluid text-center">
			<!-- Button -->
		    <div class="controls">
		    	<button class="btn btn-success">Crear</button>
		    </div> 
		</div>		
	</form>
</body>
<script>
	$('.chosen1').change(function(){ 
		var grupo = $(this).val(); 
		$('.chosen2').empty();
			//console.log(grupo);  
			$.ajax({
	        type: 'GET',
	        data: { a : 'obtenerTemas', id: grupo },
	        url: '../controladores/AdministradorControlador.php',
	        dataType: "json",
	        success: poblarSelect
	    }); 
	});

	function poblarSelect(data){
		$('.chosen2').append(data);
		$('.chosen2').trigger("chosen:updated");
	}
</script>
</html>
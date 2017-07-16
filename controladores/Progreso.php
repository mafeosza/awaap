<?php  session_start();
	
	require "../modelos/RetoModelo.php";
	require "../modelos/EstudianteModelo.php";

	/**
	* Creacion de las entidades a utilizar
	*/
	$reto = new RetoModelo();
	$estudiante = new EstudianteModelo();

	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {

		$documento = $_SESSION['documento'];	

		$informacionEstudiante = $estudiante->retosEstudiante($documento);
		#print_r($informacionEstudiante);
		$conteoRetos = 0;


		require "../vistas/Progreso.view.php";

	}else{
		header("Location: ../Index.php");
	}
?>
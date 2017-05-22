<?php session_start();
	
	require "../modelos/ProfesorModelo.php";
	require "../modelos/EspacioAcademicoModelo.php";

	$profesor = new ProfesorModelo();
	$espacioAcademico = new EspacioAcademicoModelo();

	
	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {

		$documento = $_SESSION['documento'];
		$nombre = $profesor->nombreProfesor($documento);

		$grupos = $profesor->gruposEspaciosAcademicos($documento);

		require "../vistas/InicioProfesor.view.php";
	
	}else {
		header('Location: ../Index.php');
	}

?>
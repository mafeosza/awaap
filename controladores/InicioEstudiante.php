<?php session_start();
	require "../modelos/EstudianteModelo.php";
	require "../modelos/EspacioAcademicoModelo.php";

	/**
	*Entidades a usar
	*/
	$estudiante = new EstudianteModelo();
	$espacioAcademico = new EspacioAcademicoModelo();

	
	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {
		
		$documento = $_SESSION['documento'];
		$nombre = $estudiante->nombreEstudiante($documento);

		$espacios = $estudiante->espaciosAcademicosEstudiante($documento);
		
		$retosNoCompletados = $estudiante->retosNoCompletados($documento);

		$espaciosAcademicos = $espacioAcademico->listarEspaciosAcademicos();

		require "../vistas/InicioEstudiante.view.php";
	
	}else {
		header('Location: ../Index.php');
	}

?>
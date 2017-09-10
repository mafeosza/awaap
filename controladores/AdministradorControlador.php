<?php session_start();

	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {

		//////////////////////////////////////////////
		//		  Métodos Espacio Académico			//
		//////////////////////////////////////////////

		function editarEspacio()
		{
			require "../vistas/EditarEspacio.view.php";
		}

		function eliminarEspacio()
		{
			require "../vistas/EliminarEspacio.view.php";
		}

		function crearEspacio()
		{
			require "../vistas/CrearEspacio.view.php";
		}

		//////////////////////////////////////////////
		//		     Métodos Estudiante		  		//
		//////////////////////////////////////////////

		function editarEstudiante()
		{
			require "../vistas/EditarEstudiante.view.php";
		}

		function eliminarEstudiante()
		{
			require "../vistas/EliminarEstudiante.view.php";
		}

		function registrarEstudiante()
		{
			require "../vistas/RegistroEstudiante.view.php";
		}

		//////////////////////////////////////////////
		//		     Métodos Profesor		  		//
		//////////////////////////////////////////////

		function editarProfesor()
		{
			require "../vistas/EditarProfesor.view.php";
		}

		function eliminarProfesor()
		{
			require "../vistas/EliminarProfesor.view.php";
		}

		function registrarProfesor()
		{
			require "../vistas/RegistroProfesor.view.php";
		}

		//////////////////////////////////////////////
		//		       Métodos Grupo		  		//
		//////////////////////////////////////////////

		function editarGrupo()
		{
			require "../vistas/EditarGrupo.view.php";
		}

		function eliminarGrupo()
		{
			require "../vistas/EliminarGrupo.view.php";
		}

		function crearGrupo()
		{
			require "../vistas/CrearGrupo.view.php";
		}

		function agregarEstudianteGrupo()
		{
			require "../vistas/AgregarEstudianteGrupo.view.php";
		}

		/*
		*se busca la funcion indicada por url
		*/
		$funcion = $_GET['a'];
		call_user_func($funcion);

	}
	else{
		require "../vistas/Error.php";
	}

?>
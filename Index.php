<?php session_start();
	
	require "modelos/EstudianteModelo.php";
	require "modelos/ProfesorModelo.php";
	require "modelos/AdministradorModelo.php";

	$estudiante = new EstudianteModelo();
	$profesor = new ProfesorModelo();
	$administrador = new AdministradorModelo();

	$errores= '';

	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {
		//si el documento pertenece a un estudiante
		if ($estudiante->verificarEstudiante($_SESSION['documento'])) {
			//se redirecciona al inicio de los estudiantes
			header('Location: controladores/InicioEstudiante.php');


		 //de lo contrario si el documento pertenece a un profesor
		}elseif ($profesor->verificarProfesor($_SESSION['documento'])) {
			//se redirecciona al inicio de los profesores
			header('Location: controladores/InicioProfesor.php');

		//de lo contrario si el documento pertenece al administrador	
		}elseif () {
			# code...
		}
	}
	/**
	*Verificar los datos para realizar el logeo
	*/
	if ($_SERVER['REQUEST_METHOD'] =='POST') {
		$documento = $_POST['documento'];

		$password = $_POST['password'];

		if ($estudiante->loginEstudiante($documento, $password) != false || $profesor->loginProfesor($documento, $password)) {

			$_SESSION['documento']=$documento;
			header('Location: Index.php');

		}else {

			$errores = "<li>Datos Incorrectos</li>";
			
		}

	}

	require "vistas/Index.view.php";

?>
<?php session_start();

	require "../modelos/EstudianteModelo.php";

	$estudiante = new EstudianteModelo();

	/**
	*Determinar si la sesion está definida
	*si lo está, se direcciona a index
	*/
	if (isset($_SESSION['documento'])) {
		header("Location: ../Index.php");
	}

	/**
	*Comprobar que el usuario envio los datos, 
	*verificando si se enviaron datos por el método post
	*/
	if ($_SERVER['REQUEST_METHOD'] =='POST') {
		//Se guardan los datos ingresados por el usuario en variables
		$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
		$email = $_POST['email'];
		$documento = $_POST['documento'];
		$password = $_POST['password'];
		//variable que contendra los errores del usuario
		$errores='';
		/**
		*Se comprueba que el usuario ingrese todos los datos
		*/
		if (empty($nombre) or empty($email) or empty($documento) or empty($password)) {

			$errores .= '<li>Por favor completa todos los datos correctamente</li>';

		}else{
			/**
			*Se verifica que no exista un registro previo del estudiante
			*/
			if ($estudiante->verificarEstudiante($documento) != false) {
				$errores.="<li> El usuario ya existe </li>";
			}//end if


			//cifrar clave
			$passHash = crypt($password,"%4lw4y5&c$n!0&");

		}//end else

		/**
		*Registro del estudiante
		*/
		if ($errores=='') {
			
			$estudiante->registrarEstudiante($documento, $nombre, $email, $passHash);
			echo "registro exitoso";
		}
		
	}//end if



	require "../vistas/RegistroEstudiante.view.php";

?>
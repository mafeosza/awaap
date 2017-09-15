<?php session_start();

	require "../modelos/EspacioAcademicoModelo.php";
	require "../modelos/EstudianteModelo.php";
	require "../modelos/ProfesorModelo.php";
	require "../modelos/GrupoModelo.php";

	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {

		//////////////////////////////////////////////
		//		  Métodos Espacio Académico			//
		//////////////////////////////////////////////

		function crearEspacio()
		{
			$espacioAcademico = new EspacioAcademicoModelo();

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
				$semestre = $_POST['semestre'];

				//verificar que los campos no esten vacios
				if (empty($nombre) or empty($semestre)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}

				//crear nuevo espacio academico
				if (empty($errores)) {
					$espacioAcademico->crearEspacioAcademico($nombre, $semestre);
					header('Location: ../controladores/InicioAdministrador.php');
				}
			}
			require "../vistas/CrearEspacio.view.php";
		}

		function editarEspacio()
		{
			$espacioAcademico = new EspacioAcademicoModelo();

			//id del espacio academico, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$informacionEspacio = $espacioAcademico->informacionEspacioAcademico($id);

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				
				//variable que contendra los errores del usuario
				$errores='';

				//Se guardan los datos ingresados por el usuario en variables
				$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
				$semestre = $_POST['semestre'];

				//verificar que los campos no esten vacios
				if (empty($nombre) or empty($semestre)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}

				//crear nuevo espacio academico
				if (empty($errores)) {
					$espacioAcademico->modificarEspacioAcademico($id, $nombre, $semestre);
					header('Location: ../controladores/InicioAdministrador.php');
				}
			}

			require "../vistas/EditarEspacio.view.php";
		}

		function eliminarEspacio()
		{
			#echo '<script>alert("hola"); </script>';
			#require "../vistas/EliminarEspacio.view.php";
		}

		//////////////////////////////////////////////
		//		     Métodos Estudiante		  		//
		//////////////////////////////////////////////

		function editarEstudiante()
		{	
			$estudiante = new EstudianteModelo();


			//id del espacio academico, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$informacionEstudiante = $estudiante->informacionEstudiante($id);

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {

				$claveEnBd = $estudiante->claveEstudiante($id);
				
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$documento = filter_var($_POST['documento'], FILTER_SANITIZE_STRING);
				$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
				$correo = filter_var($_POST['correo'], FILTER_SANITIZE_STRING);
				$clave = $_POST['clave'];

				
				//Se comprueba que el usuario ingrese todos los datos
				if (empty($nombre) or empty($correo) or empty($documento)) {

					$errores .= '<li>Por favor completa todos los datos correctamente</li>';

				}else{
					
					//Se verifica si se desea cambiar la clave del estudiante
					if (!empty($clave)) {
						//cifrar clave
						$passHash = crypt($clave,"%4lw4y5&c$n!0&");
						
						//Modificacion del estudiante
						$estudiante->modificarEstudiante($id, $documento, $nombre, $correo, $clave);
						header('Location: ../controladores/InicioAdministrador.php');

					}else{
						//Modificacion del estudiante
						$estudiante->modificarEstudiante($id, $documento, $nombre, $correo, $claveEnBd);
						header('Location: ../controladores/InicioAdministrador.php');
					}
				}
			}

			require "../vistas/EditarEstudiante.view.php";
		}

		function eliminarEstudiante()
		{
			require "../vistas/EliminarEstudiante.view.php";
		}

		function registrarEstudiante()
		{
			$estudiante = new EstudianteModelo();
			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
				$email = $_POST['correo'];
				$documento = $_POST['documento'];
				$clave = $_POST['clave'];

				
				//Se comprueba que el usuario ingrese todos los datos
				if (empty($nombre) or empty($email) or empty($documento) or empty($clave)) {

					$errores .= '<li>Por favor completa todos los datos correctamente</li>';

				}else{
					
					//Se verifica que no exista un registro previo del estudiante
					if ($estudiante->verificarEstudiante($documento) != false) {
						$errores.="<li> El usuario ya existe </li>";
					}//end if


					//cifrar clave
					$passHash = crypt($clave,"%4lw4y5&c$n!0&");

				}//end else

				
				//Registro del estudiante
				if (empty($errores)) {
					
					$estudiante->registrarEstudiante($documento, $nombre, $email, $passHash);
					header('Location: ../controladores/InicioAdministrador.php');
				}
			}
			require "../vistas/RegistroEstudiante.view.php";
		}

		//////////////////////////////////////////////
		//		     Métodos Profesor		  		//
		//////////////////////////////////////////////

		function editarProfesor()
		{
			$profesor = new ProfesorModelo();

			//id del espacio academico, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$informacionProfesor = $profesor->informacionProfesor($id);

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {

				$claveEnBd = $profesor->claveProfesor($id);
				
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$documento = filter_var($_POST['documento'], FILTER_SANITIZE_STRING);
				$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
				$correo = filter_var($_POST['correo'], FILTER_SANITIZE_STRING);
				$clave = $_POST['clave'];

				
				//Se comprueba que el usuario ingrese todos los datos
				if (empty($nombre) or empty($correo) or empty($documento)) {

					$errores .= '<li>Por favor completa todos los datos correctamente</li>';

				}else{
					//Se verifica si se desea cambiar la clave del profesor
					if (!empty($clave)) {
						//cifrar clave
						$passHash = crypt($clave,"%4lw4y5&c$n!0&");
						
						//Modificacion del profesor
						$profesor->modificarProfesor($id, $documento, $nombre, $correo, $clave);
						header('Location: ../controladores/InicioAdministrador.php');

					}else{
						//Modificacion del profesor
						$profesor->modificarProfesor($id, $documento, $nombre, $correo, $claveEnBd);
						header('Location: ../controladores/InicioAdministrador.php');
					}
				}
			}
			require "../vistas/EditarProfesor.view.php";
		}

		function eliminarProfesor()
		{
			require "../vistas/EliminarProfesor.view.php";
		}

		function registrarProfesor()
		{
			$profesor = new ProfesorModelo();

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
				$email = $_POST['correo'];
				$documento = $_POST['documento'];
				$clave = $_POST['clave'];

				//Se comprueba que el usuario ingrese todos los datos
				if (empty($nombre) or empty($email) or empty($documento) or empty($clave)) {

					$errores .= '<li>Por favor completa todos los datos correctamente</li>';

				}else{
					
					//Se verifica que no exista un registro previo del profesor
					if ($profesor->verificarProfesor($documento) != false) {
						$errores.="<li> El usuario ya existe </li>";
					}//end if


					//cifrar clave
					$passHash = crypt($clave,"%4lw4y5&c$n!0&");

				}//end else

				//Registro del profesor
				if (empty($errores)) {
					
					$profesor->registrarProfesor($documento, $nombre, $email, $passHash);
					header('Location: ../controladores/InicioAdministrador.php');
				}
			}

			require "../vistas/RegistroProfesor.view.php";
		}

		//////////////////////////////////////////////
		//		       Métodos Grupo		  		//
		//////////////////////////////////////////////

		function editarGrupo()
		{	
			$grupo = new GrupoModelo();
			$espacioAcademico = new EspacioAcademicoModelo();
			$profesor = new ProfesorModelo();

			//id del espacio academico, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$informacionGrupo = $grupo->informacionGrupo($id);
			$espacios = $espacioAcademico->listarEspaciosAcademicos();
			$profesores = $profesor->listarProfesores();
			$espacioAcademicoBD = $informacionGrupo['EspacioAcademico_id'];
			$profesorBD = $informacionGrupo['Profesor_id'];

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$numero = filter_var($_POST['numero'], FILTER_SANITIZE_STRING);
				$franja = $_POST['franja'];
				$espacioAcademicoSelec = $_POST['espacioAcademico'];
				$profesorSelec = $_POST['profesor'];

				if (empty($numero) or empty($franja) or empty($espacioAcademicoSelec) or empty($profesorSelec)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}
				if (empty($errores)) {

					//modificar grupo
					$grupo->modificarGrupo($id, $espacioAcademicoBD, $profesorBD, $numero, $franja, $espacioAcademicoSelec, $profesorSelec);
					header('Location: ../controladores/InicioAdministrador.php');
				}
			}

			require "../vistas/EditarGrupo.view.php";
		}

		function eliminarGrupo()
		{
			require "../vistas/EliminarGrupo.view.php";
		}

		function crearGrupo()
		{	
			$grupo = new GrupoModelo();
			$espacioAcademico = new EspacioAcademicoModelo();
			$profesor = new ProfesorModelo();

			$espacios = $espacioAcademico->listarEspaciosAcademicos();
			$profesores = $profesor->listarProfesores();

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$numero = filter_var($_POST['numero'], FILTER_SANITIZE_STRING);
				$franja = $_POST['franja'];
				$espacioAcademicoSelec = $_POST['espacioAcademico'];
				$profesorSelec = $_POST['profesor'];

				if (empty($numero) or empty($franja) or empty($espacioAcademicoSelec) or empty($profesorSelec)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}
				if (empty($errores)) {
					$grupo->crearGrupo($numero, $franja, $espacioAcademicoSelec, $profesorSelec);
					header('Location: ../controladores/InicioAdministrador.php');
				}
			}
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
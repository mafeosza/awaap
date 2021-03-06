<?php session_start();
	require "../modelos/TestModelo.php";
	require "../modelos/RetoModelo.php";
	require "../modelos/ProfesorModelo.php";
	require "../modelos/AdministradorModelo.php";

	/**
	* Creacion de las entidades a utilizar
	*/
	$test = new TestModelo();
	

	#$enunciadoTest =$test->listarEnunciados();

	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {

		function nuevo()
		{	
			$profesor = new ProfesorModelo();
			$administrador = new AdministradorModelo();

			$usuario = '';
			//se verifica si el documento pertenece a un profesor
			if ($profesor->verificarProfesor($_SESSION['documento'])) {
				$usuario = 'profesor';
			//de lo contrario si el documento pertenece al administrador	
			}elseif ($administrador->verificarAdministrador($_SESSION['documento'])) {
				$usuario = 'administrador';
			}

			//id del Reto al que pertenecera, valor numerico valido
			$idReto = isset($_GET['id']) ? (int)$_GET['id'] : false;

			#print_r($idReto);
			$test = new TestModelo();
			$reto = new RetoModelo();

			$idGrupo = $reto->grupoReto($idReto);

			/**
				*Comprobar que el usuario envio los datos, 
				*verificando si se enviaron datos por el método post
				*/
				if ($_SERVER['REQUEST_METHOD'] =='POST') {
					//variable que contendra los errores del usuario
					$errores='';

					//Se guardan los datos ingresados por el usuario en variables
					$descripcion = filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING);
					$valores = $_POST['valores'];
					$visible = $_POST['visible'];
					$lenguaje = $_POST['lenguaje'];

					if (empty($descripcion) or empty($valores) or $visible === "" or $lenguaje === "") {
						$errores.='<li>Por favor completa todos los datos correctamente</li>';
					}

					if (empty($errores)) {
						if (isset($_POST['nuevo'])) {

							$test->crearTest($descripcion, $valores, $visible, $lenguaje, $idReto);
							header('Location: ../controladores/TestControlador.php?a=nuevo&id='.$idReto);

						}elseif (isset($_POST['gFinalizar'])) {

							$test->crearTest($descripcion, $valores, $visible, $lenguaje, $idReto);
							if ($usuario == 'profesor') {
								header('Location: ../controladores/PanelControl.php?id='.$idGrupo);
							}elseif ($usuario == 'administrador') {
								header('Location: ../controladores/AdministradorControlador.php?a=verTestsReto&id='.$idReto);
							}
							
						}
					}
					if (isset($_POST['finalizar'])) {
							if ($usuario == 'profesor') {
								header('Location: ../controladores/PanelControl.php?id='.$idGrupo);
							}elseif ($usuario == 'administrador') {
								header('Location: ../controladores/AdministradorControlador.php?a=verTestsReto&id='.$idReto);
							}
					}

				}

			require "../vistas/NuevoTest.view.php";

		}

		function editar()
		{
			$profesor = new ProfesorModelo();
			$administrador = new AdministradorModelo();

			$usuario = '';
			//se verifica si el documento pertenece a un profesor
			if ($profesor->verificarProfesor($_SESSION['documento'])) {
				$usuario = 'profesor';
			//de lo contrario si el documento pertenece al administrador	
			}elseif ($administrador->verificarAdministrador($_SESSION['documento'])) {
				$usuario = 'administrador';
			}

			//id del test, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$test = new TestModelo();
			

			$infoTest = $test->datosTest($id);
			$idReto = $test->retoTest($id);
			$idGrupo = $test->grupoTest($id);
			#print_r($infoTest);
			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				
				//variable que contendra los errores del usuario
				$errores='';

				//Se guardan los datos ingresados por el usuario en variables
				$descripcion = filter_var($_POST['descripcion']);
				$valores =$_POST['valores'];
				$visible = $_POST['visible'];
				$lenguaje = $_POST['lenguaje'];

				if (empty($descripcion) or $visible === "" or $lenguaje === "") {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}

				//Modificar reto
				if(empty($errores)){
					$test->modificarTest($id, $descripcion, $valores, $visible, $lenguaje, $idReto);
					if ($usuario == 'profesor') {
						header('Location: ../controladores/PanelControl.php?id='.$idGrupo);
					}elseif ($usuario == 'administrador') {
						header('Location: ../controladores/AdministradorControlador.php?a=verTestsReto&id='.$idGrupo);
					}
				}
			}

			require "../vistas/EditarTest.view.php";
		}//end editar

		function borrar()
		{

			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			//si $id tiene como valor false, se envia al usuario a index
			if(!$id){
				header('Location: ../Index.php');
			}

			$test = new TestModelo();

			$test->eliminarTest($id);
			echo "Test eliminado";
		}

		$funcion = $_GET['a'];
		call_user_func($funcion);

	}else{
		require "../vistas/Error.php";
	}


 ?>
<?php session_start();
	
	require "../modelos/UnidadModelo.php";

	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {

		//Método que agrega una unidad dado su id
		function nuevo()
		{
			$unidad = new UnidadModelo();
			//id espacio academico al que pertenecera la unidad, valor numerico valido
			$idEspacio = isset($_GET['id']) ? (int)$_GET['id'] : false;

			if(!$idEspacio){
				header('Location: ../vistas/Error.php');
			}

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';

				$numero = $_POST['numero'];

				if (empty($numero)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}else{
					$unidad->crearUnidad($numero, $idEspacio);
					if (isset($_POST['crear'])) {
						header('Location: ../controladores/AdministradorControlador.php?a=verUnidades');
					}
					if (isset($_POST['temas'])) {
						header('Location: ../controladroes/AdministradorControlador.php?a=crearTema'.$idEspacio);
					}
				}
			}

			require "../vistas/CrearUnidad.view.php";
		}

		//Método que modifica una unidad dado su id
		function editar()
		{
			$unidad = new UnidadModelo();

			//id unidad valor numerico valido
			$idUnidad = isset($_GET['id']) ? (int)$_GET['id'] : false;

			if(!$idUnidad){
				header('Location: ../vistas/Error.php');
			}

			$informacionUnidad = $unidad->informacionUnidad($idUnidad);

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';

				$numero = $_POST['numero'];

				if (empty($numero)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}else{
					$unidad->editarUnidad($numero, $idUnidad, $informacionUnidad['EspacioAcademico_id'] );
					header('Location: ../controladores/AdministradorControlador.php?a=verUnidades');
				}
			}

			require "../vistas/EditarUnidad.view.php";

		}

		//Método que elimina una unidad dado su id
		function borrar()
		{
			$unidad = new UnidadModelo();

			//id unidad valor numerico valido
			$idUnidad = isset($_GET['id']) ? (int)$_GET['id'] : false;

			if(!$idUnidad){
				header('Location: ../vistas/Error.php');
			}

			$unidad->eliminarUnidad($idUnidad);
			header('Location: ../controladores/AdministradorControlador.php?a=verUnidades');

		}

		$funcion = $_GET['a'];
		call_user_func($funcion);
	}
	else{
		header('Location: ../Index.php');
	}
?>
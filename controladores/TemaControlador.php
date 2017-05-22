<?php session_start();

	require "../modelos/TemaModelo.php";

	if (isset($_SESSION['documento'])) {
		
		/**
		*$id id del tema
		*Se verifica que se haya enviado un id valido por la url
		* de lo contrario se establece la variable $id con el valor false
		*/
		$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

		//si $id tiene como valor false, se envia al usuario a index
		if(!$id){
			header('Location: ../Index.php');
		}

		$temaModelo = new TemaModelo();

		$espacioAcademico = $temaModelo->espacioAcademicoTema($id);
		$nombre = $temaModelo->nombreTema($id);

		$retos = $temaModelo->retosTema($id);
		
		#print_r($espacioAcademico[0]['id']);


		require "../vistas/Tema.view.php";
	}else {
		header('Location: ../vistas/Error.php');
	}
?>
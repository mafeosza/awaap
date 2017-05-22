<?php session_start();
	
	require "../modelos/GrupoModelo.php";
	require "../modelos/TestModelo.php";

	/**
	* Creacion de las entidades a utilizar
	*/
	$grupo = new GrupoModelo();

	$test = new TestModelo();

	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {

		$documento = $_SESSION['documento'];	

		$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

		if(!$id){
			header('Location: ../Index.php');
		}



		$infoRetos = $grupo->retosGrupo($id);
		$contReto = 1;

	
		

		require "../vistas/PanelControl.view.php";	
	}else{
		header("Location: ../Index.php");
	}


?>
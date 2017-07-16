<?php session_start();

	require "../modelos/TemaModelo.php";
	require "../modelos/EstudianteModelo.php";
	require "../modelos/GrupoModelo.php";

	if (isset($_SESSION['documento'])) {

		$documento = $_SESSION['documento'];
		
		/**
		*$id id del tema
		*Se verifica que se haya enviado un id valido por la url
		*de lo contrario se establece la variable $id con el valor false
		*/
		$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

		//si $id tiene como valor false, se envia al usuario a index
		if(!$id){
			header('Location: ../Index.php');
		}

		/**
		* Creacion de las entidades a utilizar
		*/
		$temaModelo = new TemaModelo();
		$estudiante = new EstudianteModelo();
		$grupo = new GrupoModelo();

		$espacioAcademico = $temaModelo->espacioAcademicoTema($id);
		$idEspacio = $espacioAcademico[0]['id'];
		

		$grupos = $estudiante->grupoEspacioAcademico($documento, $idEspacio);
		$idGrupo = $grupos[0]['idGrupo'];
		
		$retos= $grupo->retosGrupoTema($idGrupo, $id);


		$nombre = $temaModelo->nombreTema($id);
		
		
#		print_r($retos);


		require "../vistas/Tema.view.php";
	}else {
		header('Location: ../vistas/Error.php');
	}
?>
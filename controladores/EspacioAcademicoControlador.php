<?php session_start();
	require "../modelos/EspacioAcademicoModelo.php";
	require "../modelos/UnidadModelo.php";

	if (isset($_SESSION['documento'])) {

		$id = isset($_GET['id']) ? (int)$_GET['id'] : false;
		#$idg = isset($_GET['idg']) ? (int)$_GET['idg'] : false;

		if(!$id and !$idg){
			header('Location: ../Index.php');
		}
		
		$espacioAcademico = new EspacioAcademicoModelo();
		$unidadM = new UnidadModelo();
		
		
		$nombre = $espacioAcademico->nombreEspacioAcademico($id);

		$materiales = $espacioAcademico->obtenerMateriales($id);
		

		$unidades = $espacioAcademico->obtenerUnidades($id);
		

		$nombreTab = '';
		$contenidoTab = '';
		$count = 0;

		while ($unidad = $unidades[$count]) 
		{
			if($count == 0){
				
				$nombreTab.='<li class="active"><a href="#'.$unidad['id'].'" data-toggle="tab">Unidad '.$unidad['numero'].'</a></li>';

				$contenidoTab.='
				<div id="'.$unidad['id'].'" class="tab-pane fade in active">
				';
				
			}
			else{
				
				$nombreTab.='<li><a href="#'.$unidad['id'].'" data-toggle="tab"> Unidad '.$unidad['numero'].'</a></li>';

				$contenidoTab.='
				<div id="'.$unidad['id'].'" class="tab-pane fade">
				';
			}

			$temas = $unidadM->temasUnidad($unidad['id']);
			#print_r($temas);
			$subCount = 0;
			while ($tema = $temas[$subCount]) {
				$contenidoTab.= '
				<a href="../controladores/TemaControlador.php?id='.$tema['id'].'"><h4>'.$tema['nombre'].'</h4></a>
				';
				$subCount++;
			}
			$contenidoTab.='</div>'; 
			$count++;
		}


	
		
		require "../vistas/EspacioAcademico.view.php";
	}else {
		header('Location: ../vistas/Error.php');
	}
?>
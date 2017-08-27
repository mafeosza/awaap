<?php session_start();
	/**
	*Determinar si la sesión está definida 
	*/
	#if (isset($_SESSION['documento'])) {
		require "../vistas/InicioAdministrador.view.php";
	
	#}else {
	#	header('Location: ../Index.php');
	#}
?>
<?php
	require_once("Modelo.php");

	/**
	* 
	*/
	class IntentoModelo extends Modelo
	{
			
		function __construct()
		{
			parent::__construct(); 
		}

		/**
		*Atributos de la clase Test Intento
		*/
		private $id;
		private $superado;
		private $puntaje;

		/**
		*Constructor de la clase Intento
		*/
		public function TestIntentoModelo()
		{
			$id = "";
			$superado = "";
			$puntaje = "";
		}

		/*
		*Método que crea un intento
		*/
		public function crearIntento($superado, $puntaje, $idReto, $idEstudiante){

			$sql = "INSERT INTO `Intento` (`superado`, `puntaje`, `Reto_id`, `Estudiante_id`) VALUES ('$superado', '$puntaje', '$idReto', '$idEstudiante')";
			$consulta = $this->query($sql);

		}
		/*
		*Método que 
		UPDATE `Intento` SET `superado` = '1' WHERE `Intento`.`id` = 1 AND `Intento`.`Reto_id` = 1 AND `Intento`.`Estudiante_id` = 7;
		*/
	
	}
?>
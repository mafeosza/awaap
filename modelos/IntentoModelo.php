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
		*Método que actualiza el estado, superado o no superado, de un intento dado su id 
		UPDATE `Intento` SET `superado` = '1' WHERE `Intento`.`id` = 1 AND `Intento`.`Reto_id` = 1 AND `Intento`.`Estudiante_id` = 7;
		*/
		public function cambiarEstado($idIntento, $idReto, $idEstudiante, $superado){
			$sql = "UPDATE `Intento` SET `superado` = '$superado' WHERE `Intento`.`id` = $idIntento AND `Intento`.`Reto_id` = $idReto AND `Intento`.`Estudiante_id` = $idEstudiante";
			$consulta = $this->query($sql);

		}
		/**
		*Método que el id del último intento creado en un reto por un estudiante
		*dado el id del reto y el id del estudiante
		*/
		public function idIntento($idReto, $idEstudiante){
			$sql= "SELECT max(id) FROM `Intento` WHERE `Reto_id`= '$idReto' AND `Estudiante_id` = '$idEstudiante' LIMIT 1";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();

			$idIntento = $datos[0];

			return $idIntento;
		}

	
	}
?>
<?php
	require_once("Modelo.php");

	/**
	* 
	*/
	class UnidadModelo extends Modelo
	{
		function __construct()
		{
			parent::__construct(); 
		}

		/**
		*Atributos de la clase Unidad
		*/
		private $id;
		private $numero;

		/**
		*Constructor de la clase Unidad
		*/
		public function UnidadModelo()
		{
			$id = "";
			$numero = "";
		}

		/**
		*Método que crea una unidad
		*/
		public function crearUnidad($numero, $idEspacio)
		{
			$sql = "INSERT INTO `Unidad` (`numero`, `EspacioAcademico_id`) VALUES ('$numero', '$idEspacio')";
			$consulta = $this->query($sql);
		}

		/**
		*Método que edita una unidad
		*/
		public function editarUnidad($numero, $id, $idEspacio)
		{
			$sql = "UPDATE `Unidad` SET `numero` = '$numero' WHERE `Unidad`.`id` = $id AND `Unidad`.`EspacioAcademico_id` = $idEspacio;";
			$consulta = $this->query($sql);
		}

		/**
		*Método que elimina una unidad
		*/
		public function eliminarUnidad($idUnidad)
		{
			$sql = "DELETE FROM `Unidad` WHERE `Unidad`.`id` = $idUnidad";
			$consulta = $this->query($sql);
		}

		/*
		*Método que da la informacion de una unidad
		*/
		public function informacionUnidad($idUnidad)
		{
			$sql = "SELECT * FROM `Unidad` WHERE id = $idUnidad";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();

			return $datos;
		}

		/**
		*Método que retorna los temas de una unidad dado su id
		*/
		public function temasUnidad($id)
		{
			$sql = "SELECT a.id, a.nombre FROM `Tema` a, `Unidad` b 
			WHERE 
			b.id = a.Unidad_id 
			AND b.id = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}

		/**
		*Método que retorna el espacio academico al que pertenece la unidad
		*/
		public function espacioAcademicoUnidad($id)
		{
			$sql = "SELECT a.id, a.nombre FROM `EspacioAcademico` a, `Unidad` b 
			WHERE b.EspacioAcademico_id = a.id 
			AND b.id = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();

			return $datos;
		}
	}
?>
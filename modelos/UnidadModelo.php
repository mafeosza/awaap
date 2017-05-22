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
		public function UnidadModelo(){
			$id = "";
			$numero = "";
		}

		/**
		*Método que retorna los temas de una unidad dado su id
		*/
		public function temasUnidad($id){
			$sql = "SELECT a.id, a.nombre FROM `Tema` a, `Unidad` b 
			WHERE 
			b.id = a.Unidad_id 
			AND b.id = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}
	}
?>
<?php

	require_once("Modelo.php");

	/**
	* 
	*/
	class TemaModelo extends Modelo
	{
		function __construct()
		{
			parent::__construct(); 
		}

		/**
		*Atributos de la clase Tema
		*/
		private $id;
		private $nombre;

		/**
		*Constructor de la clase Tema
		*/
		public function TemaModelo(){
			$id = "";
			$nombre = "";
		}
		/**
		*Método que retorna el nombre del tema
		*/
		public function nombreTema($id){
			$sql = "SELECT `nombre` FROM `Tema` WHERE `id` = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();

			$nombre = $datos[0];
			return $nombre;
		}
		/**
		*Método que retorna el espacio academico al que pertenece el tema dado su id
		*/
		public function espacioAcademicoTema($id){
			$sql = "SELECT a.id, a.nombre FROM `EspacioAcademico` a, `Tema` b, `Unidad` c 
			WHERE 
			c.id = b.Unidad_id 
			AND a.id = c.EspacioAcademico_id 
			AND b.id = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}

		/**
		*Método que obtiene los retos de un tema
		*/
		public function retosTema($id){
			$sql = "SELECT a.id, a.titulo, a.imagen FROM `Reto` a, `Tema` b 
			WHERE
			b.id = a.Tema_id 
			AND b.id = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}
		
	}
?>
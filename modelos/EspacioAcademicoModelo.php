<?php  
	require_once("Modelo.php");

	/**
	* 
	*/
	class EspacioAcademicoModelo extends Modelo
	{
		function __construct()
		{
			parent::__construct(); 
		}

		/**
		*Atributos de la clase Espacio Academico
		*/
		private $id;
		private $nombre;

		/**
		*Constructor de la clase Espacio Academico
		*/
		public function EspacioAcademicoModelo(){
			$id = "";
			$nombre = "";
		}

		/**
		*Método que lista los espacios academicos
		*/
		public function listarEspaciosAcademicos(){
			$sql = "SELECT * FROM `EspacioAcademico`";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();
			
			return $datos;
		}

		/**
		*Método que retorna el nombre del espacio académico
		*/
		public function nombreEspacioAcademico($id){
			$sql = "SELECT `nombre` FROM `EspacioAcademico` WHERE `id` = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();

			$nombre = $datos[0];
			return $nombre;			
		}

		/**
		*Método que retorna las unidades de un espacio academico 
		*/
		public function obtenerUnidades($id){
			$sql = "SELECT a.id, a.numero FROM `Unidad` a, `EspacioAcademico` b 
			WHERE 
			b.id = a.EspacioAcademico_id 
			AND b.id = $id";
			$consulta =$this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();
			
			return $datos;

		}

		/**
		*Método que retorna los materiales de un espacio académico 
		*/
		public function obtenerMateriales($id){
			$sql = "SELECT a.id, a.url, a.nombre FROM `Material` a, `Tema` b, `Unidad` c, `EspacioAcademico` d 
			WHERE 
			a.Tema_id = b.id 
			AND b.Unidad_id = c.id 
			AND c.EspacioAcademico_id = d.id 
			AND d.id = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;

		} 

	}


?>
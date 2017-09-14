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
		private $semestre;

		/**
		*Constructor de la clase Espacio Academico
		*/
		public function EspacioAcademicoModelo()
		{
			$id = "";
			$nombre = "";
			$semestre = "";
		}

		/**
		*Método que crea un espacio academico
		*/
		public function crearEspacioAcademico($nombre, $semestre)
		{
			$sql = "INSERT INTO `EspacioAcademico` (`nombre`, `semestre`) VALUES ('$nombre', '$semestre')";
			$consulta = $this->query($sql);
		}

		/**
		*Método que modifica un espacio académico
		*/
		public function modificarEspacioAcademico($id, $nombre, $semestre)
		{
			$sql="UPDATE `EspacioAcademico` SET `nombre` = '$nombre', `semestre` = '$semestre'
			WHERE `EspacioAcademico`.id = '$id'";
			#print_r($sql);
			$consulta = $this->query($sql);
		}

		/**
		*Método que brinda la información de un espacio académico
		*/
		public function informacionEspacioAcademico($id)
		{
			$sql="SELECT * FROM `EspacioAcademico` WHERE `id` = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();
			return $datos;
		}

		/**
		*Método que lista los espacios academicos
		*/
		public function listarEspaciosAcademicos()
		{
			$sql = "SELECT * FROM `EspacioAcademico` ORDER BY `semestre`";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();
			
			return $datos;
		}

		/**
		*Método que retorna el nombre del espacio académico
		*/
		public function nombreEspacioAcademico($id)
		{
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
		public function obtenerUnidades($id)
		{
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
		public function obtenerMateriales($id)
		{
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
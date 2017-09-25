<?php

	require_once("Modelo.php");

	/**
	* 
	*/
	class GrupoModelo extends Modelo
	{
		
		function __construct()
		{
			parent::__construct(); 
		}
		/**
		*Atributos de la clase Grupo
		*/
		private $id;
		private $numero;
		private $franja;

		/**
		*Constructor de la clase Grupo
		*/
		public function GruporModelo()
		{
			$id = "";
			$numero = "";
			$franja = "";
		}

		/**
		*Método que crea un grupo
		*/
		public function crearGrupo($numero, $franja, $espacioAcademico, $profesor)
		{
			$sql = "INSERT INTO `Grupo` (`numero`, `franja`, `Profesor_id`, `EspacioAcademico_id`) VALUES ('$numero', '$franja', '$profesor', '$espacioAcademico')";
			$consulta = $this->query($sql);
		}

		/**
		*Método que modifica un grupo 
		*/
		public function modificarGrupo($id, $espacioAcademicoBD, $profesorBD, $numero, $franja, $espacioAcademico, $profesor)
		{
			$sql="UPDATE `Grupo` SET `numero` = '$numero', `franja` = '$franja', `EspacioAcademico_id` = '$espacioAcademico', `Profesor_id` = '$profesor' 
			WHERE `Grupo`.`id` = '$id' AND `Grupo`.`Profesor_id` = '$profesorBD' AND `Grupo`.`EspacioAcademico_id` = '$espacioAcademicoBD'";
			$consulta = $this->query($sql);
		}

		/**
		*Método que elimina un grupo 
		*/
		public function eliminarGrupo($id)
		{
			$sql = "DELETE FROM `Grupo` WHERE `Grupo`.`id` = $id";
			$consulta = $this->query($sql);
		}

		/**
		*Método que brinda la información de un grupo
		*/
		public function informacionGrupo($id)
		{
			$sql="SELECT * FROM `Grupo` WHERE `id` = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();
			return $datos;
		}

		/**
		*Método que retorna los estudiantes en un grupo dado su id
		*/
		public function listarEstudiantes($id)
		{
			$sql = "SELECT a.id, a.documento as documento, a.nombre as nombre FROM `Estudiante` a, `Grupo` b, `Registro` c 
			WHERE a.id = c.Estudiante_id AND b.id = c.Grupo_id AND b.id = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();
			return $datos;
		}

		/**
		*Método que retorna los estudiantes que NO estan en un determinado grupo
		*/
		public function listarOtrosEstudiantes($id)
		{
			$sql = "SELECT * FROM Estudiante es WHERE es.documento NOT IN (SELECT a.documento FROM Estudiante a, Grupo b, Registro c 
			WHERE a.id = c.Estudiante_id AND b.id = c.Grupo_id AND b.id = $id)";
			$consulta = $this->query($sql);
			
			$datos = array();
			$datos = $consulta->fetchAll();
			return $datos;
		}

		/**
		*Método que retorna los grupos en la bd con el profesor y el espacio académico
		*/
		public function listarGrupos()
		{
			$sql = "SELECT a.id, a.numero, a.franja, b.nombre as nombreProfesor, c.nombre as nombreEspacio FROM `Grupo` a, `Profesor` b, `EspacioAcademico` c 
			WHERE b.id = a.Profesor_id AND c.id = EspacioAcademico_id";
			$consulta = $this->query($sql);
			$resultado = $consulta->fetchAll();

			return $resultado;
		}

		/**
		*Método que retorna la información más detallada de un grupo
		*/
		public function informacionDetallesGrupo($id)
		{
			$sql = "SELECT a.id, a.numero, a.franja, b.nombre as nombreProfesor, c.nombre as nombreEspacio FROM `Grupo` a, `Profesor` b, `EspacioAcademico` c 
			WHERE b.id = a.Profesor_id AND c.id = EspacioAcademico_id AND a.id = $id";
			$consulta = $this->query($sql);
			$resultado = $consulta->fetch();

			return $resultado;
		}

		/**
		*Método que retorna los retos de un grupo
		*/
		public function retosGrupo($id)
		{
			$sql = "SELECT a.id, a.titulo, a.descripcionCorta, a.imagen FROM `Reto` a WHERE a.Grupo_id = $id";

			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}

		/**
		*Método que retorna los retos de un grupo dado el id del grupo y del tema
		*/
		public function retosGrupoTema($idGrupo, $idTema)
		{
			$sql = "SELECT a.id, a.titulo, a.descripcionCorta, a.imagen, a.solucionPython, a.solucionJava FROM `Reto` a 
			WHERE 
			a.Grupo_id = $idGrupo 
			AND a.Tema_id = $idTema";

			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}

		/**
		*Método que retorna los temas del espacio academico al que pertenece el grupo dado su id
		*/
		public function temasGrupo($id)
		{
			$sql = "SELECT a.id, a.nombre FROM `Tema` a, `Unidad` b, `EspacioAcademico` c, `Grupo` d 
			WHERE 
			b.id = a.Unidad_id
			AND c.id = b.EspacioAcademico_id
			AND c.id = d.EspacioAcademico_id
			AND d.id = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}
	}	
?>
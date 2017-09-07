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
		*Constructor de la clase Profesor
		*/
		public function GruporModelo()
		{
			$id = "";
			$numero = "";
			$franja = "";
		}

		/**
		*Método que retorna los grupos con el nombre del profesor y el espacio académico
		*/
		public function listarGrupos()
		{
			$sql = "SELECT a.id, a.numero, a.franja, b.nombre as nombreProfesor, c.nombre as nombreEspacio FROM `Grupo` a, `Profesor` b, `EspacioAcademico` c WHERE b.id = a.Profesor_id AND c.id = EspacioAcademico_id";
			$consulta = $this->query($sql);
			$resultado = $consulta->fetchAll();

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
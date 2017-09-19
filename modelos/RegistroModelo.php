<?php
	require_once("Modelo.php");

	/**
	* 
	*/
	class RegistroModelo extends Modelo
	{
		
		function __construct()
		{
			parent::__construct();
		}

		/**
		*Atributos de la clase Registro
		*/
		private $id;

		/**
		*Constructor de la clase Registro
		*/
		public function RegistroModelo()
		{
			$id = "";
		}

		/**
		*Método que realiza un registro
		*/
		function registroEstudiante()
		{
			$sql = "";
		}

		/**
		*Método que agrega un registro
		*/
		function agregarRegistro($idGrupo, $idProfesor, $idEstudiante)
		{
			$sql = "INSERT INTO `Registro` (`Grupo_id`, `Grupo_Profesor_id`, `Estudiante_id`) VALUES ('$idGrupo', '$idProfesor', '$idEstudiante')";
			$consulta = $this->query($sql);
		}

		/**
		*Método que elimina un registro
		*/
		function eliminarRegistro($idRegistro, $idGrupo, $idProfesor, $idEstudiante)
		{
			$sql= "DELETE FROM `Registro` WHERE `Registro`.`id` = $idRegistro AND `Registro`.`Grupo_id` = $idGrupo AND `Registro`.`Grupo_Profesor_id` = $idProfesor AND `Registro`.`Estudiante_id` = $idEstudiante";
			$consulta = $this->query($sql);
		}

		/**
		*Método que retorna el id de un registro dado el grupo y el estudiante
		*/
		function idRegistro($idGrupo, $idEstudiante)
		{
			$sql = "SELECT id FROM `Registro` 
			WHERE Grupo_id = $idGrupo AND Estudiante_id = $idEstudiante";
			$consulta = $this->query($sql);
			
			$datos= array();
			$datos = $consulta->fetch();
			$id = $datos[0];

			return $id;
		}

		/**
		*Método que retorna el id del profesor del registro
		*/
		function idProfesor($idRegistro)
		{
			$sql = "SELECT Grupo_Profesor_id FROM `Registro` WHERE id = $idRegistro";
			$consulta = $this->query($sql);
			
			$datos= array();
			$datos = $consulta->fetch();
			$id = $datos[0];

			return $id;	
		}
	}
?>
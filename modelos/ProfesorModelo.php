<?php

	require_once("Modelo.php");
	
	/**
	* 
	*/
	class ProfesorModelo extends Modelo
	{
		function __construct()
		{
			parent::__construct(); 
		}

		/**
		*Atributos de la clase Profesor
		*/
		private $id;
		private $documento;
		private $nombre;
		private $email;
		private $clave;

		/**
		*Constructor de la clase Profesor
		*/
		public function ProfesorModelo()
		{
			$id = "";
			$documento = "";
			$nombre = "";
			$email = "";
			$clave = "";
		}

		/*
		*Método que retorna todos los profesores
		*/
		public function listarProfesores()
		{
			$sql = "SELECT * FROM `Profesor`";
			$consulta = $this->query($sql);
			$resultado = $consulta->fetchAll();

			return $resultado;
		}

		/**
		*Método que verifique si un profesor ya esta registrado
		*/
		public function  verificarProfesor($documento)
		{
			$sql = "SELECT * FROM `Profesor` WHERE `documento` = $documento";
			$consulta = $this->query($sql);
			$resultado = $consulta->fetch();

			return $resultado;
		}

		/**
		* Método que retorna el nombre de un profesor dado su documento
		*/
		public function nombreProfesor($documento)
		{
			$sql = "SELECT `nombre` FROM `Profesor` WHERE `documento` = $documento";
			$consulta = $this->query($sql);
			
			$datos= array();
			$datos = $consulta->fetch();
			$nombre = $datos[0];

			return $nombre;
		}

		/**
		*Método que registra un profesor
		*/
		public function registrarProfesor($documento, $nombre, $email, $password)
		{
			$sql = "INSERT INTO `Profesor` (`documento`, `nombre`, `correo`, `clave`) VALUES ('$documento', '$nombre', '$email', '$password')";
			$consulta = $this->query($sql);
		}

		/**
		*Método que modifica un profesor 
		*/
		public function modificarProfesor($id, $documento, $nombre, $correo, $clave)
		{
			$sql="UPDATE `Profesor` SET `documento` = '$documento', `nombre` = '$nombre', `correo` = '$correo', `clave` = '$clave'
			WHERE `Profesor`.id = '$id'";
			$consulta = $this->query($sql);
		}

		/**
		*Método que brinda la informacion de un profesor
		*/
		public function informacionProfesor($id)
		{
			$sql = "SELECT * FROM `Profesor` WHERE `id` = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();
			return $datos;
		}

		/**
		*Método que comprueba si el documento coincide con la clave en la base de datos
		*/
		public function loginProfesor($documento, $password)
		{
			$sql = "SELECT `clave` FROM `Profesor` WHERE `documento` = $documento";
			$consulta = $this->query($sql);
			
			$datos= array();

			$datos = $consulta->fetch();
			$passHash = $datos[0];
			

			$isclave = hash_equals($passHash, crypt($password, "%4lw4y5&c$n!0&"));

			if ($isclave) {

				return true;
				
			} else {

				return false;
			}
		}

		/**
		* Método que retorna la clave de un profesor dado su id
		*/
		public function claveProfesor($id)
		{
			$sql = "SELECT `clave` FROM `Profesor` WHERE `id` = $id";
			$consulta = $this->query($sql);
			
			$datos= array();
			$datos = $consulta->fetch();
			$clave = $datos[0];

			return $clave;
		}

		/**
		*Método que retorna los grupos de los espacios academicos de un profesor
		*/
		public function gruposEspaciosAcademicos($documento)
		{
			$sql = "SELECT a.id, a.numero, a.franja, a.EspacioAcademico_id FROM `Grupo` a, `Profesor` b 
			WHERE 
			b.id = a.Profesor_id
			AND b.documento = $documento";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			#print_r($datos);
			return $datos;
		}

		/**
		*Método que retorna los retos de un profesor
		*/
		function retosProfesor($id){
			$sql = "SELECT a.id, a.titulo, a.solucionPython as python, a.solucionJava as java, b.id as idTema, b.nombre as nombreTema, c.id as idGrupo, c.numero, c.franja, e.id as idEspacio, e.nombre as espacioAcademico FROM `Reto` a, `Tema` b, `Grupo` c, `Profesor` d, `EspacioAcademico` e
			WHERE 
			a.Grupo_id = c.id AND
			a.Tema_id = b.id AND
			c.Profesor_id = d.id AND
			c.EspacioAcademico_id = e.id AND
			d.id = $id ";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}
	}

?>
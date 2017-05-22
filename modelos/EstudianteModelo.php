<?php  
	require_once("Modelo.php");

	/**
	* 
	*/
	class EstudianteModelo extends Modelo
	{
		
		function __construct()
		{
			parent::__construct(); 
		}

		/**
		*Atributos de la clase Estudiante
		*/
		private $id;
		private $documento;
		private $nombre;
		private $email;
		private $clave;

		/**
		*Constructor de la clase Estudiante
		*/
		public function EstudianteModelo()
		{
			$id = "";
			$documento = "";
			$nombre = "";
			$email = "";
			$clave = "";
		}

		/**
		*Método que verifique si un estudiante ya esta registrado
		*/
		public function  verificarEstudiante($documento)
		{
			$sql = "SELECT * FROM `Estudiante` WHERE `documento` = $documento";
			$consulta = $this->query($sql);
			$resultado = $consulta->fetch();

			return $resultado;
		}
		
		/**
		*Método que registra un usuario
		*/
		public function registrarEstudiante($documento, $nombre, $email, $password){
			$sql = "INSERT INTO `Estudiante` (`documento`, `nombre`, `correo`, `clave`) VALUES ('$documento', '$nombre', '$email', '$password')";
			$consulta = $this->query($sql);
		}

		/**
		*Método que comprueba si el documento coincide con la clave en la base de datos
		*/
		public function loginEstudiante($documento, $password){
			$sql = "SELECT `clave` FROM `Estudiante` WHERE `documento` = $documento";
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
		* Método que retorna el nombre de un estudiante dado su documento
		*/
		public function nombreEstudiante($documento){
			$sql = "SELECT `nombre` FROM `Estudiante` WHERE `documento` = $documento";
			$consulta = $this->query($sql);
			
			$datos= array();
			$datos = $consulta->fetch();
			$nombre = $datos[0];

			return $nombre;
		}

		/**
		*Método que retorna el id de un estudiante dado su documento
		*/
		public function idEstudiante($documento){
			$sql = "SELECT `id` FROM `Estudiante` WHERE `documento` = $documento";
			$consulta = $this->query($sql);
			
			$datos= array();
			$datos = $consulta->fetch();
			$id = $datos[0];

			return $id;
		}

		/**
		*Método que retorna el nombre de los espacios academicos de un estudiante
		*/
		public function espaciosAcademicosEstudiante($documento){
			$sql = "SELECT a.nombre, a.id FROM `EspacioAcademico` a, `Estudiante` b, `Grupo` c, `Registro` d 
			WHERE 
			b.id = d.Estudiante_id
			AND c.id = d.Grupo_id
			AND a.id = c.EspacioAcademico_id
			AND b.documento = $documento";
			$consulta = $this->query($sql);
			
			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}

		/**
		*Método que retorna los retos que no ha finalizado el estudiante
		*/
		public function retosNoCompletados($documento){
			$sql="SELECT a.titulo, a.id FROM `Reto` a, `Intento` b, `Estudiante` c 
			WHERE 
			c.id = b.Estudiante_id
			AND a.id = b.Reto_id
			AND c.documento = $documento
			AND b.superado = 0";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}

		
	}
?>
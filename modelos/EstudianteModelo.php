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
		*Método que retorna la información de todos los estudiantes
		*/
		public function listarEstudiantes()
		{
			$sql = "SELECT * FROM `Estudiante`";
			$consulta = $this->query($sql);
			$resultado = $consulta->fetchAll();

			return $resultado;
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
		public function registrarEstudiante($documento, $nombre, $email, $password)
		{
			$sql = "INSERT INTO `Estudiante` (`documento`, `nombre`, `correo`, `clave`) VALUES ('$documento', '$nombre', '$email', '$password')";
			$consulta = $this->query($sql);
		}

		/**
		*Método que modifica un estudiante 
		*/
		public function modificarEstudiante($id, $documento, $nombre, $correo, $clave)
		{
			$sql="UPDATE `Estudiante` SET `documento` = '$documento', `nombre` = '$nombre', `correo` = '$correo', `clave` = '$clave'
			WHERE `Estudiante`.id = '$id'";
			$consulta = $this->query($sql);
		}

		/**
		*Método que brinda la informacion de un estudiante
		*/
		public function informacionEstudiante($id)
		{
			$sql = "SELECT * FROM `Estudiante` WHERE `id` = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();
			return $datos;
		}

		/**
		*Método que comprueba si el documento coincide con la clave en la base de datos
		*/
		public function loginEstudiante($documento, $password)
		{
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
		public function nombreEstudiante($documento)
		{
			$sql = "SELECT `nombre` FROM `Estudiante` WHERE `documento` = $documento";
			$consulta = $this->query($sql);
			
			$datos= array();
			$datos = $consulta->fetch();
			$nombre = $datos[0];

			return $nombre;
		}

		/**
		* Método que retorna la clave de un estudiante dado su id
		*/
		public function claveEstudiante($id)
		{
			$sql = "SELECT `clave` FROM `Estudiante` WHERE `id` = $id";
			$consulta = $this->query($sql);
			
			$datos= array();
			$datos = $consulta->fetch();
			$clave = $datos[0];

			return $clave;
		}

		/**
		*Método que retorna el id de un estudiante dado su documento
		*/
		public function idEstudiante($documento)
		{
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
		public function espaciosAcademicosEstudiante($documento)
		{
			$sql = "SELECT a.nombre, a.id, c.id as 'idGrupo' FROM `EspacioAcademico` a, `Estudiante` b, `Grupo` c, `Registro` d 
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
		*Método que retorna el grupo de un espacio academico al que pertenece un estudiante
		*/
		public function grupoEspacioAcademico($documento, $idEspacio)
		{
			$sql = "SELECT c.id as 'idGrupo' FROM `EspacioAcademico` a, `Estudiante` b, `Grupo` c, `Registro` d 
			WHERE 
			b.id = d.Estudiante_id
			AND c.id = d.Grupo_id
			AND a.id = c.EspacioAcademico_id
			AND b.documento = $documento
			AND a.id = $idEspacio";
			$consulta = $this->query($sql);
			
			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}

		/**
		*Método que retorna los retos que no ha finalizado el estudiante
		*/
		public function retosNoCompletados($documento)
		{
			$sql="SELECT DISTINCT(b.id),b.titulo FROM `Intento` a,`Reto` b,`Estudiante` c 
			WHERE a.Estudiante_id = c.id 
			AND a.Reto_id = b.id 
			AND a.superado = 0 
			AND c.documento = $documento 
			AND b.id NOT IN ( 
			    SELECT DISTINCT(e.id) FROM `Intento` d, `Reto` e, `Estudiante` f 
			    WHERE d.Estudiante_id = f.id 
			    AND d.Reto_id = e.id 
			    AND d.superado = 1 
			    AND f.documento = $documento);";
      		
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}

		/**
		*Método que lista la información de los retos intentados por el estudiante
		*para la vista miPrograso
		*/
		public function retosEstudiante($documento)
		{
			$sql = "SELECT a.titulo, c.nombre, COUNT(DISTINCT e.id) as 'conteo', f.lenguaje, MAX(e.fecha) as 'fecha',
			MAX(e.puntaje) as 'puntaje', MAX(e.superado) as 'superado'
			FROM `Reto` a, `Grupo` b, `EspacioAcademico` c, `Registro` d, `Intento` e, `Test` f, `Estudiante` g
			WHERE 
			a.Grupo_id = b.id 
			AND b.EspacioAcademico_id = c.id 
			AND d.Grupo_id = b.id 
			AND d.Estudiante_id = g.id 
			AND e.Reto_id = a.id 
			AND e.Estudiante_id = g.id 
			AND f.Reto_id = a.id 
			AND g.documento = '$documento'
			GROUP BY a.id";
			
			$consulta = $this->query($sql);
			
			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;

		}
	}
?>
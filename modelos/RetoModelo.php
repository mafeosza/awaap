<?php
	require_once("Modelo.php");

	/**
	*
	*/
	Class RetoModelo extends Modelo
	{
		function __construct()
		{
			parent::__construct(); 
		}

		/**
		*Atributos de la clase Reto
		*/
		private $id;
		private $nivelDificultad;
		private $titulo;
		private $descripcionCorta;
		private $especificaciones;
		private $solucionPython;
		private $solucionJava;
		private $imagen;

		/**
		*Constructor de la clase Reto
		*/
		public function RetoModelo()
		{
			$id = "";
			$nivelDificultad = "";
			$titulo = "";
			$descripcionCorta = "";
			$especificaciones = "";
			$solucionPython = "";
			$solucionJava = "";
			$imagen = "";
		}

		/**
		*Método que crea un reto nuevo
		*/
		public function crearReto($titulo, $descripcionCorta, $especificaciones, $nivelDificultad, $solucionPython, $solucionJava, $idTema, $imagen, $idGrupo)
		{
			$sql = "INSERT INTO `Reto` (`nivelDificultad`, `titulo`, `descripcionCorta`, `especificaciones`, `solucionPython`, `solucionJava`, `imagen`, `Tema_id`, `Grupo_id`) VALUES ('$nivelDificultad', '$titulo', '$descripcionCorta', '$especificaciones', '$solucionPython', '$solucionJava', '$imagen', '$idTema', '$idGrupo')";
			$consulta = $this->query($sql);
		}

		/**
		*Método que modifica un reto
		*/
		public function modificarReto($id, $titulo, $descripcionCorta, $especificaciones, $nivelDificultad, $solucionPython, $solucionJava, $idTema, $idTemaGuardado, $imagen, $idGrupo)
		{
			$sql ="UPDATE `Reto` SET `nivelDificultad` = '$nivelDificultad', `titulo` = '$titulo', `descripcionCorta` = '$descripcionCorta', `especificaciones` = '$especificaciones', `solucionPython` = '$solucionPython', `solucionJava` = '$solucionJava', `imagen` = '$imagen', `Tema_id` = '$idTema' 
			WHERE `Reto`.`id` = $id AND `Reto`.`Tema_id` = $idTemaGuardado";
			$consulta = $this->query($sql);

		}	

		/**
		*Método que elimina un reto
		*ALTER TABLE Test ADD FOREIGN KEY(Reto_id) REFERENCES Reto(id) ON DELETE CASCADE
		*/
		public function eliminarReto($id)
		{
			$sql = "DELETE FROM `Reto` WHERE `id` = $id";
			#print_r($sql);
			$consulta = $this->query($sql);
		}
		/**
		*Método que retorna la información del reto
		*/
		public function informacionReto($id)
		{
			$sql = "SELECT * FROM `Reto` WHERE `id` = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}

		/**
		*Método que retorna el id del último reto creado en un grupo
		*dado el id del grupo
		*/
		public function idUltimoReto($idGrupo)
		{
			$sql = "SELECT max(id) FROM `Reto` WHERE `Grupo_id`= '$idGrupo' LIMIT 1";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();

			$idReto = $datos[0];

			return $idReto;
		}

		/**
		*Método que retorna el nombre del reto
		*/
		public function nombreReto($id)
		{
			$sql = "SELECT `titulo` FROM `Reto` WHERE `id` = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();

			$nombreReto = $datos[0];

			return $nombreReto;

		}
		
		/**
		*Método que retorna el espacio academico al que pertenece el reto dado su id
		*/
		public function espacioAcademicoReto($id)
		{
			$sql = "SELECT a.id, a.nombre FROM `EspacioAcademico` a, `Tema` b, `Unidad` c, `Reto` d 
			WHERE
			b.id = d.Tema_id 
			AND c.id = b.Unidad_id 
			AND a.id = c.EspacioAcademico_id 
			AND b.id = $id";
			
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}

		/**
		*Método que retorna el tema al que pertenece el reto dado su id
		*/
		public function temaReto($id)
		{
			$sql = "SELECT a.id, a.nombre FROM `Tema` a, `Reto` b 
			WHERE
			a.id = b.Tema_id 
			AND b.id = $id";
			
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
		}

		/**
		*Método que retorna el grupo al que pertenece el reto dado su id
		*/
		public function grupoReto($id)
		{
			$sql = "SELECT `Grupo_id` FROM `Reto` WHERE `id`= $id";
			$consulta=$this->query($sql);
			
			$datos=array();
	  		$datos = $consulta->fetch();
	  		$idGrupo = $datos[0];
	  		
	  		return $idGrupo;
		}
		/**
		*Método que lista la solucion python del reto
		*/
	  	public function respuestaPython($id)
	  	{
	  		$sql= "SELECT `solucionPython` FROM `Reto` WHERE `id`= $id";
	  		$consulta=$this->query($sql);

	  		$datos=array();
	  		$datos = $consulta->fetch();
	  		$respuesta = $datos[0];
	  		
	  		return $respuesta;
	  	}
	  	/**
		*Método que lista la solucion java del reto
		*/
	  	public function respuestaJava($id)
	  	{
	  		$sql= "SELECT `solucionJava` FROM `Reto` WHERE `id`= $id";
	  		$consulta=$this->query($sql);

	  		$datos=array();
	  		$datos = $consulta->fetch();
	  		$respuesta = $datos[0];
	  		
	  		return $respuesta;
	  	}

	  	/**
	  	*Método que retorna la cantidad de tests de un reto dado su id y el lenguaje 
	  	*/
	  	public function cantidadTest($id, $lenguaje)
	  	{

	  		$sql = "SELECT COUNT(a.id) FROM `Test` a, `Reto` b 
			WHERE
			b.id = a.Reto_id 
			AND a.lenguaje = '$lenguaje'
			AND b.id = $id";
			#print_r($sql);
	  		$consulta = $this->query($sql);

	  		$datos = array();
	  		$datos = $consulta->fetch();
	  		$cantidad = $datos[0];

	  		return $cantidad;
		}
		
	}	

?>
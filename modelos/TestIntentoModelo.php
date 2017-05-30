<?php
	require_once("Modelo.php");

	/**
	*
	*/
	class TestIntentoModelo extends Modelo
	{
		function __construct()
		{
			parent::__construct();
		}

		/**
		*eAtributos de la clase Test Intento
		*/
		private $id;
		private $superado;


		/**
		*Constructor de la clase TestIntento
		*/
		public function TestIntentoModelo()
		{
			$id = "";
			$superado = "";
			
		}

		/**
		*Método que crea un testIntento
		*/
		public function crearTestIntento($superado, $idIntento, $idTest)
		{
			$sql = "INSERT INTO `IntentoTest` (`superado`, `Intento_id`, `Test_id`) VALUES ('$superado', '$idIntento', '$idTest')";
			#print_r($sql);
			$consulta = $this->query($sql);

		}

		/**
	  	*Método que lista los intentos de un test por un estudiante
	  	*dado el id del reto y del estudiante
	  	*/
	  	public function intetosTestReto($idReto, $idEstudiante){
	  		$sql= "SELECT a.id, a.superado FROM `IntentoTest` a, `Intento` b, `Reto` c, `Estudiante` d
	  		WHERE
	  		a.Intento_id = b.id
	  		AND c.id = $idReto
	  		AND d.id = $idEstudiante";
	  		$consulta = $this->query($sql);

	  		$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
	  	}

	  	/**
	  	*Método que retorna si un test ha sido superado o no y el id del intentoTest dado el id del test
	  	*/
	  	public function isSuperadoTest($idTest, $idIntento){
	  		$sql = "SELECT a.superado FROM `IntentoTest`a 
	  		WHERE a.`Test_id` = $idTest 
	  		AND a.`Intento_id` = $idIntento";
	  		$consulta = $this->query($sql);

	  		$datos = array();
	  		$datos = $consulta->fetch();

	  		$superado = $datos[0];

	  		return $superado;
	  	}
	}
?>

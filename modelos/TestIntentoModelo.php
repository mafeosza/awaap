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
	}
?>

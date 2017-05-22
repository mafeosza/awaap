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
		*Atributos de la clase Test Intento
		*/
		private $id;
		private $superado;
		private $fecha;

		/**
		*Constructor de la clase TestIntento
		*/
		public function TestIntentoModelo()
		{
			$id = "";
			$superado = "";
			$fecha = "";
		}
			
		/**
		*Método que crea un testIntento
		*/
		public function crearTestIntento($superado, $fecha, $idIntento, $idTest)
		{
			$sql = "INSERT INTO `IntentoTest` (`superado`, `fecha`, `Intento_id`, `Test_id`) VALUES ('$superado', '$fecha', '$idIntento', '$idTest')";
			$consulta = $this->query($sql);

		}
	}
?>
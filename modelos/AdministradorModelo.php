<?php
	require_once("Modelo.php");

	/**
	* 
	*/
	class AdministradorModelo extends Modelo
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
		*Constructor de la clase Administrador
		*/
		public function AdministradorModelo()
		{
			$id = "";
			$documento = "";
			$nombre = "";
			$email = "";
			$clave = "";
		}

		/**
		*Método que verifique si un administrador ya esta registrado
		*/
		public function  verificarAdministrador($documento)
		{
			$sql = "SELECT * FROM `Administrador` WHERE `documento` = $documento";
			$consulta = $this->query($sql);
			$resultado = $consulta->fetch();

			return $resultado;
		}

		/**
		* Método que retorna el nombre de un administrador dado su documento
		*/
		public function nombreAdministrador($documento){
			$sql = "SELECT `nombre` FROM `Administrador` WHERE `documento` = $documento";
			$consulta = $this->query($sql);
			
			$datos= array();
			$datos = $consulta->fetch();
			$nombre = $datos[0];

			return $nombre;
		}

		/**
		*Método que comprueba si el documento coincide con la clave en la base de datos
		*/
		public function loginAdministrador($documento, $password){

			$sql = "SELECT `clave` FROM `Administrador` WHERE `documento` = $documento";
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
	}
?>
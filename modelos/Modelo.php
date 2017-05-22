<?php
	class Modelo
	{
		protected $conexion;
		protected $host;
		protected $db_name;
		protected $username;
		protected $password;

		function __construct()
		{
			$host = "localHost";
			$db_name = "awaap";
			$username = "root";
			$password = "root";

			try {
					$this->conexion = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
				
			} catch (PDOException $exception) {
				
				echo "Error de conexion".$exception->getMessage();
				
			}
		}

		protected function query($query)
		{
			$result = $this->conexion->prepare($query);
			$result-> execute();
			return $result;
		}
	}
?>
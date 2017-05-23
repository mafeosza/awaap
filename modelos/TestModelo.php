<?php 
	require_once("Modelo.php");

	/**
	*
	*/
	Class TestModelo extends Modelo
	{
		function __construct()
		{
			parent::__construct(); 
		}

		/**
		*Atributos clase Test
		*/
		private $id;
		private $numero;
		private $descripcion;
		private $valores;
		private $visible;

		public function TestModelo()
		{
			$id= "";
			$numero = "";
			$descripcion = "";
			$valores = "";
			$visible = "";
		} 
		/**
		*CREATE TABLE awaap.IntentoTest (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `Intento_id` INT NOT NULL,
		  `Test_id` INT NOT NULL,
		  `superado` tinyint(1),
		  `fecha` date,
		  PRIMARY KEY (`id`, `Intento_id`,`Test_id`),
		  INDEX `fk_IntentoTest_idx` (`Test_id` ASC),
		  CONSTRAINT `fk_Intento`
		    FOREIGN KEY (`Intento_id`)
		    REFERENCES `awaap`.`Intento` (`id`),
		    CONSTRAINT `fk_Test`
		    FOREIGN KEY (`Test_id`)
		    REFERENCES `awaap`.`Test` (`id`)
		    ON DELETE cascade
		    ON UPDATE cascade);
    */

		/**
		*Método que crea un nuevo test
		$descripcion, $valores, $visible, $lenguaje, $idReto
		*/
		public function crearTest($descripcion, $valores, $visible, $lenguaje, $idReto){
			$sql="INSERT INTO `Test` (`descripcion`, `valores`, `visible`, `lenguaje`, `Reto_id`) VALUES ('$descripcion', \"$valores\", '$visible', '$lenguaje', '$idReto')";
			#print_r($sql);
			$consulta = $this->query($sql);
		}

		/**
		  * Método que obtiene la informacion del test dado su id
		*/
		public function datosTest($id){
			$sql = "SELECT a.id, a.descripcion, a.valores, a.visible, a.lenguaje FROM `Test` a 
			WHERE
			a.id = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;	
		}

		/**
		  * Método que obtiene la informacion del test dado el id del reto
		*/
		public function informacionTest($id){
			$sql = "SELECT a.id, a.descripcion, a.valores, a.visible, a.lenguaje FROM `Test` a, `Reto` b 
			WHERE
			b.id = a.Reto_id 
			AND b.id = $id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;	
		}

		/**
		*Método que modifica un test dado su id
		*/
		public function modificarTest($id, $descripcion, $valores, $visible, $lenguaje, $idReto){
			$sql = "UPDATE `Test` SET `descripcion` = '$descripcion', `valores` = \"$valores\", `visible` = '$visible', `lenguaje` = '$lenguaje' WHERE `Test`.`id` = $id AND `Test`.`Reto_id`=$idReto";
			$consulta = $this->query($sql);
			#print_r($sql);
			$datos = array();
			$datos = $consulta->fetchAll();

		}

		/**
		*Método que elimina un test
		*/
		public function eliminarTest($id){
			$sql = "DELETE FROM `Test` WHERE `id` = $id";
			#print_r($sql);
			$consulta = $this->query($sql);
		}

		/**
		*Método que retorna el id del reto al que pertenece un test dado su id
		*/
		public function retoTest($id){
			$sql = "SELECT a.id FROM `Reto` a, `Test` b 
			WHERE
			a.id=b.Reto_id 
			AND b.id=$id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();

			$id = $datos[0];
			return $id;	

		}

		/**
		*Método que retorna el grupo al que pertenece un test dado su id
		*/
		public function grupoTest($id){
			$sql = "SELECT a.Grupo_id FROM `Reto` a, `Test` b
			WHERE
			a.id = b.Reto_id
			AND b.id = 	$id";
			$consulta = $this->query($sql);

			$datos = array();
			$datos = $consulta->fetch();

			$id = $datos[0];
			return $id;	
		}

	  	/**
	  	*Método que lista los valores de los tests dado el id del reto
	  	*/
	  	public function listarValores($id)
	  	{
	  		$sql ="SELECT `valores` FROM `Test` WHERE `Reto_id`= $id";
	  		$consulta=$this->query($sql);

	   		$datos=array();
	   		$datos = $consulta->fetchAll();

		    return $datos;	
	  	}
	  	
	  	/**
	  	*Método que lista los intentos de un test por un estudiante 
	  	*dado el id del test y del estudiante
	  	*/
	  	public function intetosTestReto($idTest, $idEstudiante){
	  		$sql= "SELECT a.id, a.superado, a.fecha FROM `IntentoTest` a, `Intento` b, `Estudiante` c
	  		WHERE
	  		a.Intento_id = b.id 
	  		AND a.Test_id = $idTest
	  		AND c.id = $idEstudiante";
	  		$consulta = $this->query($sql);	  		

	  		$datos = array();
			$datos = $consulta->fetchAll();

			return $datos;
	  	}
	}
 ?>
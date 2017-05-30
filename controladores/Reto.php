<?php session_start();
	
	require "../modelos/RetoModelo.php";
	require "../modelos/TestModelo.php";
	require "../modelos/IntentoModelo.php";
	require "../modelos/TestIntentoModelo.php";
	require "../modelos/EstudianteModelo.php";

	//////////////////////////////////////////////////////////
	//					Entidades a usar					//
	//////////////////////////////////////////////////////////

		$reto = new RetoModelo();
		$testModelo = new TestModelo();
		$intento = new IntentoModelo();
		$testIntento = new TestIntentoModelo();
		$estudiante = new EstudianteModelo();


	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {

		/**
		*documento del estudiante
		*/
		$documentoEstudiante = $_SESSION['documento'];
		$idEstudiante = $estudiante->idEstudiante($documentoEstudiante);
		

		/**
		*$id id del reto
		*Se verifica que se haya enviado un id valido por la url
		* de lo contrario se establece la variable $id con el valor false
		*/
		$idReto = isset($_GET['id']) ? (int)$_GET['id'] : false;

		/**
		*se inicializa las variables superado, puntaje y número de test superados
		*/
		$superado = 0;
		$puntaje = 0;
		$testSuperados = 0;
		#se entra al boton
		$isBoton=0;

		//si $id tiene como valor false, se envia al usuario a index
		if(!$idReto){
			header('Location: ../Index.php');
		}


		//////////////////////////////////////////////////////////
		//						Variables						//
		//////////////////////////////////////////////////////////	

			$nombreReto = $reto->nombreReto($idReto);
			$espacioAcademico = $reto->espacioAcademicoReto($idReto);	

			$temaReto = $reto->temaReto($idReto);

			$datosReto = $reto->informacionReto($idReto);

			$tests = $testModelo->informacionTest($idReto);

			#lenguaje en que se intentara resolver el reto
			$lenguajeIntento = "";	

			$respuesta = $reto->respuestaPython($idReto);
			$codigo = "";

			$contenidoLi = "";
			$i = 1;

			$porcentaje = 0;
			$rSuperado = 0;
			$isSuperado	= "";
		//se muestran los test visibles del reto

		for ($j=0; $j < count($tests); $j++) 
		{ 

			$test = $tests[$j];

			#seleccion lenguaje python
			$lenguajeIntento = "python";
			if($test['visible'] == 1 and $test['lenguaje']==$lenguajeIntento){
				
					$contenidoLi.= '<div id="div'.$test['id'].'" class="alert alert-info"  ><li id="test'.$test['id'].'" >Test '.$i.'. '.$test['descripcion'].'</li></div>';
				/*if (condition){
					contenidoLi
					$contenidoLi.= '<div class="alert alert-success"><li>Test '.$i.'. '.$test['descripcion'].'</li></div>';

				}else{
					$contenidoLi.= '<div class="alert alert-danger"><li>Test '.$i.'. '.$test['descripcion'].'</li></div>';
				}*/
				$i++;	
			}
		}
		
		
		//////////////////////////////////////////////////////////
		//					Archivos Temporales					//
		//////////////////////////////////////////////////////////

			/**
			*Archivo temporal para el código del profesor
			**/

			$temp = tmpfile();
			fwrite($temp, $respuesta);
			fseek($temp, 0);
			$tempA= fread($temp, 1024);	

			/**
			*Método que compara las salidas del código del estudiante
			*con las del código del profesor
			*/
			function compararCodigo($salidaEstudiante, $valor, $tempA, $idTest, $testIntento, $superado, $idIntento, $testSuperados,$rSuperado)
			{
				$descriptorspec =array(
					0 => array("pipe", "r"),  //gestor de escritura conectado al stdin hijo
					1 => array("pipe", "w"),  //gestor de lectura conectado al stdout hijo
				);

					$process = proc_open('python -c "'.$tempA.'"', $descriptorspec, $pipes);

					if (is_resource($process)) 
					{
						fwrite($pipes[0], $valor);
						fclose($pipes[0]);
						

						if ($salidaEstudiante == stream_get_contents($pipes[1]))
						{
							//se crea un nuevo testIntento SUPERADO
							$superado = 1;
							//se aumenta un reto superado
							$rSuperado++;
							
							//se crea un intento test SUPERADO
						$testIntento->crearTestIntento($superado, $idIntento, $idTest);

							#echo "<script> alert('Bien hecho!'); </script>";
							echo "bien hecho! <br>";

							//se retornan la cantidad de retos superados
							return $rSuperado;
						}else {
							//se crea un nuevo testIntento NO superado
						$testIntento->crearTestIntento($superado, $idIntento, $idTest);
							
							print_r(stream_get_contents($pipes[1]));
							#echo "<script> alert('verifique su codigo'); </script>";
							echo "revisa tu codigo <br>";
						}
							
						fclose($pipes[1]);

						$return_value = proc_close($process);
					}

			}#fin metodo compararCodigo


		if ($_SERVER['REQUEST_METHOD'] =='POST') 
		{	
			$isBoton = 1;
			//se obtiene la fecha actual del sistema y se acomoda para el formato mysql
			$date = getdate();
			$fecha = $date['year']."-".$date['mon']."-".$date['mday']." ".$date['hours'].":".$date['minutes'].":".$date['seconds'];

			$cantidadTest = $reto->cantidadTest($idReto, $lenguajeIntento);
			 
			//se crea un nuevo intento cuando el usuario presiona el boton
		$intento->crearIntento($fecha, $superado, $puntaje, $idReto, $idEstudiante);
			//se obtiene el id del intento creado
		$idIntento = $intento->idIntento($idReto, $idEstudiante);
		
			//se recorre el arreglo de valores para validar el código del estudiante
			for ($i=0; $i < count($tests); $i++) 
			{ 	
				$test = $tests[$i];
				
				#print_r($tests);
				if($test['lenguaje']=="python"){	
					
					$valor = $test['valores'];
					$codigo = $_POST['codigo'];

					$descriptorspec =array(
						0 => array("pipe", "r"),  //gestor de lectura conectado al stdin hijo
						1 => array("pipe", "w"),  //gestor de escritura conectado al stdout hijo
						2 => array("pipe", "w")   //gestor de escritura conectado al stderr hijo
					);

					$process = proc_open('python -c "'.$codigo.'"', $descriptorspec, $pipes);

					if (is_resource($process)) 
					
					{	
						fwrite($pipes[0], $valor);
						fclose($pipes[0]);

						$salida= stream_get_contents($pipes[1]);
						$error = stream_get_contents($pipes[2]);

						//id del test que se esta evaluando
						$idTest = $tests[$i]['id'];

						if (!is_null($salida)) 
						{
							
							$testSuperados+= compararCodigo($salida, $valor, $tempA, $idTest, $testIntento, $superado, $idIntento, $testSuperados, $rSuperado);
							
							#print_r($salida);
					
							print_r($error);
						}else
						{
							//se crea un nuevo testIntento NO superado
						$testIntento->crearTestIntento($superado, $idIntento, $idTest);
							
						}
						
						fclose($pipes[1]);
						fclose($pipes[2]);		
						$return_value = proc_close($process);

					} #fin if

				}#fin if
			}#fin for

			if ($cantidadTest == $testSuperados) {
			 	echo "<script> alert(':D completado!!'); </script>";
			 	$superado = 1;
			 	$intento->cambiarEstado($idIntento, $idReto, $idEstudiante, $superado);
			 	$porcentaje = 100;
			 	
			 } else{
			 	#echo "<script> alert('sigue intentando ;)'); </script>";
			 	echo "sigue intentando";
			 	if ($cantidadTest != 0) {
			 		
			 		$porcentaje = ($testSuperados * 100) /$cantidadTest;


			 		
			 	}else{
			 		$porcentaje = 0;
			 	}

			 }
			 
		}#fin if REQUEST_METHOD	
					
		/**
		*Eliminar archivo temporal código profesor
		**/
		fclose($temp);
		
		require "../vistas/Reto.view.php";
	}else {
		header('Location: ../vistas/Error.php');
	}
?>
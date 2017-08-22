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
		*$lenguaje en que se solucionara el reto
		*Se verifica que se haya enviado un lenguaje valido por la url
		* de lo contrario se establece la variable $lenguaje con el valor false
		*/
		$lenguaje = isset($_GET['l']) ? $_GET['l'] : false;

		/**
		*se inicializa las variables superado, puntaje y número de test superados
		*/
		$superado = 0;
		$puntaje = 0;
		$testSuperados = 0;
		#se presiona boton enviar
		$presionaBoton=0;

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

		$nivelDificultad = $datosReto[0]['nivelDificultad'];

		$tests = $testModelo->informacionTest($idReto);

		#lenguaje en que se intentara resolver el reto
		$lenguajeIntento = "";	

		$respuesta = $reto->respuestaPython($idReto);
		$respuestaJava = $reto->respuestaJava($idReto);

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

			#mostrar los test dependiendo del lenguaje seleccionado
			$lenguajeIntento = $lenguaje; //se debe defnir segun la seleccion
			if($test['visible'] == 1 and $test['lenguaje']==$lenguajeIntento){
				
				$contenidoLi.= '<div id="div'.$test['id'].'" class="alert alert-info"  ><li id="test'.$test['id'].'" >Test '.$i.'. '.$test['descripcion'].'</li></div>';
				$i++;	
			}
		}

		//////////////////////////////////////////////////////////
		//				  	     Métodos			  	 	    //
		//////////////////////////////////////////////////////////

		/**
		*Método que compara las salidas del código del estudiante
		*con las del código del profesor
		*para el lenguaje java
		*/
		function compararCodigoJava($salidaEstudiante,$valor, $idEstudiante, $respuestaJava)
		{
			$error="";
			//////////////////////////////////////////////////////////
			//			 	 Archivos Temporales Java				//
			//////////////////////////////////////////////////////////
			$temporalJava = fopen('/tmp/tempProfesor'.$idEstudiante.'.java', "a+");
			fwrite($temporalJava, "import java.util.Scanner; public class tempProfesor".$idEstudiante."{ public static void main(String args[]){");
			fwrite($temporalJava, $respuestaJava);
			fwrite($temporalJava, "}}");
			fclose($temporalJava);

			//t carpeta donde se guardaran los archivos java, suma2.java archivo con el codigo java a ejecutar
			$process_cmd = "cd /tmp;/usr/bin/javac tempProfesor".$idEstudiante.".java";
			$env = NULL;
			$options = ["bypass_shell" => true];
			$cwd = NULL;

			$descriptorspec =array( 
				0 => array("pipe", "r"),  //gestor de escritura conectado al stdin hijo
				1 => array("pipe", "w"),  //gestor de lectura conectado al stdout hijo
				2 => array("pipe", "w")   //gestor de escritura conectado al stderr hijo
			);
			//process2 proceso para compilar java - errores de sintaxis (syntax error)
			$process2 = proc_open($process_cmd, $descriptorspec, $pipes, $cwd, $env, $options);

			if (is_resource($process2)){
				#$salida= stream_get_contents($pipes[1]);
				$error = stream_get_contents($pipes[2]);

				#print_r($salida);	
				print_r($error);

				fclose($pipes[1]);
				fclose($pipes[2]);		
				$return_value = proc_close($process2);

			}
			//proceso para ejecutar java - salidas, errores de ejecucion (null pointer exception)
			$process_cmd = "cd /tmp;/usr/bin/java tempProfesor".$idEstudiante;
			$env = NULL;
			$options = ["bypass_shell" => true];
			$cwd = NULL;
				
			$descriptorspec =array( 
				0 => array("pipe", "r"),  //gestor de escritura conectado al stdin hijo
				1 => array("pipe", "w"),  //gestor de lectura conectado al stdout hijo
				2 => array("pipe", "w")   //gestor de escritura conectado al stderr hijo
			);
			$process = proc_open($process_cmd, $descriptorspec, $pipes, $cwd, $env, $options);

			if (is_resource($process)){
				fwrite($pipes[0], $valor);
				fclose($pipes[0]);

				$salida= stream_get_contents($pipes[1]);
				#$error = stream_get_contents($pipes[2]);

				if ($salida == $salidaEstudiante) {
					echo "bien hecho";
					#print_r($salida);
				}else{
					echo "revisa tu codigo";
				}
							
				#print_r($error);

				fclose($pipes[1]);
				fclose($pipes[2]);		
				$return_value = proc_close($process);
			}	
			exec("cd /tmp;rm tempProfesor".$idEstudiante.".class");
			exec("cd /tmp; rm tempProfesor".$idEstudiante.".java");		
		}

		/////////////////////////////
		//   Archivos Temporales   //
		/////////////////////////////

		/**
		*Archivo temporal para ejecutar 
		*el código python del profesor
		**/
		$temp = tmpfile();
		fwrite($temp, $respuesta);
		fseek($temp, 0);
		$tempA= fread($temp, 1024);	

		/**
		*Método que compara las salidas del código del estudiante
		*con las del código del profesor
		*para el lenguaje python
		*/
		function compararCodigoPython($salidaEstudiante, $valor, $tempA, $idTest, $testIntento, $superado, $idIntento, $testSuperados,$rSuperado)
		{
			$descriptorspec =array(
				0 => array("pipe", "r"),  //gestor de escritura conectado al stdin hijo
				1 => array("pipe", "w"),  //gestor de lectura conectado al stdout hijo
			);

			$process = proc_open('python -c "'.$tempA.'"', $descriptorspec, $pipes);

			if (is_resource($process)){
				fwrite($pipes[0], $valor);
				fclose($pipes[0]);
					
				if ($salidaEstudiante == stream_get_contents($pipes[1])){
					//se crea un nuevo testIntento SUPERADO
					$superado = 1;
					//se aumenta un reto superado
					$rSuperado++;
					
					//se crea un intento test SUPERADO
					$testIntento->crearTestIntento($superado, $idIntento, $idTest);

					//se retornan la cantidad de retos superados
					return $rSuperado;
				}else{
					//se crea un nuevo testIntento NO superado
					$testIntento->crearTestIntento($superado, $idIntento, $idTest);
							
					print_r(stream_get_contents($pipes[1]));
						
				}
						
					fclose($pipes[1]);
					$return_value = proc_close($process);
			}

		}#fin metodo compararCodigoPython

		#si el usuario presentara el reto en python
		if($lenguaje=="python"){
			if ($_SERVER['REQUEST_METHOD'] =='POST'){	
				$presionaBoton = 1;
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

						if (is_resource($process)){	
							fwrite($pipes[0], $valor);
							fclose($pipes[0]);

							$salida= stream_get_contents($pipes[1]);
							$error = stream_get_contents($pipes[2]);

							//id del test que se esta evaluando
							$idTest = $tests[$i]['id'];

							if (!is_null($salida)){				
								$testSuperados+= compararCodigoPython($salida, $valor, $tempA, $idTest, $testIntento, $superado, $idIntento, $testSuperados, $rSuperado);				
						
								print_r($error);
							}else{
								//se crea un nuevo testIntento NO superado
								$testIntento->crearTestIntento($superado, $idIntento, $idTest);
								
							}
							
							fclose($pipes[1]);
							fclose($pipes[2]);		
							$return_value = proc_close($process);

						} #fin if
					}#fin if
				}#fin for

				if ($cantidadTest == $testSuperados){
				 	$superado = 1;
				 	$intento->cambiarEstado($idIntento, $idReto, $idEstudiante, $superado);
				 	$porcentaje = 100;

				 	#se calcula el puntaje
				 	$puntaje = $nivelDificultad * $porcentaje;
				 	#se cambia el puntaje del intento
				 	$intento->cambiarPuntaje($puntaje, $idIntento, $idReto, $idEstudiante);
				 	
				} else{

				 	if ($cantidadTest != 0) {
				 		#se calcula el porcentaje aprobado 
				 		$porcentaje = ($testSuperados * 100) /$cantidadTest;

				 		#se calcula el puntaje
					 	$puntaje = $nivelDificultad * $porcentaje;
					 	
					 	#se cambia el puntaje del intento
					 	$intento->cambiarPuntaje($puntaje, $idIntento, $idReto, $idEstudiante);
				 		
				 	}else{
				 		$porcentaje = 0;
				 	}
				}		 
			}#fin if REQUEST_METHOD	
		}#fin if lenguaje python	
		/**
		*Eliminar archivo temporal código profesor
		**/
		fclose($temp);

		#si la solución se presenta en java
		if ($lenguaje=="java") {
			if ($_SERVER['REQUEST_METHOD'] =='POST'){

				$codigo = $_POST['codigo'];
				$error="";

				//////////////////////////////////////////////////////////
				//			 	 Archivos Temporales Java				//
				//////////////////////////////////////////////////////////
				$temporalJava = fopen('/tmp/tempEstudiante'.$idEstudiante.'.java', "a+");
				fwrite($temporalJava, "import java.util.Scanner; public class tempEstudiante".$idEstudiante."{ public static void main(String args[]){");
				fwrite($temporalJava, $codigo);
				fwrite($temporalJava, "}}");
				fclose($temporalJava);

				for ($i=0; $i < count($tests); $i++) 
				{ 
					$test = $tests[$i];
					if ($test['lenguaje']== "java") {
						$valor = $test['valores'];

						//t carpeta donde se guardaran los archivos java, suma2.java archivo con el codigo java a ejecutar
						$process_cmd = "cd /tmp;/usr/bin/javac tempEstudiante".$idEstudiante.".java";
						$env = NULL;
						$options = ["bypass_shell" => true];
						$cwd = NULL;

						$descriptorspec =array( 
							0 => array("pipe", "r"),  //gestor de escritura conectado al stdin hijo
							1 => array("pipe", "w"),  //gestor de lectura conectado al stdout hijo
							2 => array("pipe", "w")   //gestor de escritura conectado al stderr hijo
							);
						//process2 proceso para compilar java - errores de sintaxis (syntax error)
						$process2 = proc_open($process_cmd, $descriptorspec, $pipes, $cwd, $env, $options);

						if (is_resource($process2)){
							#$salida= stream_get_contents($pipes[1]);
							$error = stream_get_contents($pipes[2]);

							#print_r($salida);	
							print_r($error);

							fclose($pipes[1]);
							fclose($pipes[2]);		
							$return_value = proc_close($process2);

						}
						//proceso para ejecutar java - salidas, errores de ejecucion (null pointer exception)
						$process_cmd = "cd /tmp;/usr/bin/java tempEstudiante".$idEstudiante;
						$env = NULL;
						$options = ["bypass_shell" => true];
						$cwd = NULL;
				
						$descriptorspec =array( 
							0 => array("pipe", "r"),  //gestor de escritura conectado al stdin hijo
							1 => array("pipe", "w"),  //gestor de lectura conectado al stdout hijo
							2 => array("pipe", "w")   //gestor de escritura conectado al stderr hijo
						);
							$process = proc_open($process_cmd, $descriptorspec, $pipes, $cwd, $env, $options);

						if (is_resource($process)){
							fwrite($pipes[0], $valor);
							fclose($pipes[0]);

							$salida= stream_get_contents($pipes[1]);
							$error = stream_get_contents($pipes[2]);

							#print_r($salida);	
							if (!is_null($salida)){
								compararCodigoJava($salida, $valor, $idEstudiante, $respuestaJava);
							}
							print_r($error);

							fclose($pipes[1]);
							fclose($pipes[2]);		
							$return_value = proc_close($process);
						}

					}
				}#fin for tests

				exec("cd /tmp;rm tempEstudiante".$idEstudiante.".class");
				exec("cd /tmp; rm tempEstudiante".$idEstudiante.".java");
			}#fin if REQUEST_METHOD
		}#fin if lenguaje java
			
			require "../vistas/Reto.view.php";
	}else {
		header('Location: ../vistas/Error.php');
	}
?>
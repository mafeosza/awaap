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
		$test = new TestModelo();
		$intento = new IntentoModelo();
		$testIntento = new TestIntentoModelo();
		$estudiante = new EstudianteModelo();



	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {

		/**
		*$id id del reto
		*Se verifica que se haya enviado un id valido por la url
		* de lo contrario se establece la variable $id con el valor false
		*/
		$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

		//si $id tiene como valor false, se envia al usuario a index
		if(!$id){
			header('Location: ../Index.php');
		}

		//////////////////////////////////////////////////////////
		//						Variables						//
		//////////////////////////////////////////////////////////	

			$nombreReto = $reto->nombreReto($id);
			$espacioAcademico = $reto->espacioAcademicoReto($id);	

			$temaReto = $reto->temaReto($id);

			$datosReto = $reto->informacionReto($id);

			$tests = $test->informacionTest($id);	

			$respuesta = $reto->respuestaPython($id);
			$codigo = "";

			$valoresTest = $test->listarValores($id);
			#print_r($valoresTest);
			#$valor = $valoresTest[0]['valores'];
			
			#print_r($valoresTest[1]['valores']);
		
			$contenidoLi = "";
			$count =0;
			$i = 1;
		//se muestran los test visibles del reto
		while ($test = $tests[$count] ) {
			if($test['visible'] == 1 and $test['lenguaje']=="python"){
				$contenidoLi.= '<div class="alert alert-danger"><li>Test '.$i.'. '.$test['descripcion'].'</li></div>';
				$i++;	
			}
			$count++;
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
			function compararCodigo($salidaEstudiante,$valor,$tempA)
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
						
							#echo "<script> alert('Bien hecho!'); </script>";
							echo "bien hecho! <br>";
						}else {
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
			for ($i=0; $i < count($valoresTest); $i++) 
			{ 
				$valor = $valoresTest[$i]['valores'];
				
				if ($tests[$i]['lenguaje']==="python") 
				{	
				
					#print_r($tests);


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

						if (!is_null($salida)) 
						{
							compararCodigo($salida,$valor,$tempA);
							#print_r($salida);
							
							print_r($error);
						}#fin if

						fclose($pipes[1]);
						fclose($pipes[2]);		
						$return_value = proc_close($process);

					} #fin if

				}#fin if
			}#fin for
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
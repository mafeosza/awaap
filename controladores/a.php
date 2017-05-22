<?php
	include_once("../modelos/RetoModelo.php");
	include_once("../modelos/TestModelo.php");

	//////////////////////////////////////////////////////////
	//					Entidades a usar					//
	//////////////////////////////////////////////////////////
		$reto = new RetoModelo();
		$test = new TestModelo();

		$enunciado = $reto->listarEnunciado();
		$respuesta = $reto->listarRespuesta();
		$valoresTest = $test->listarValores();

		$valor = $valoresTest[1]['valores'];
		$codigo = $respuesta[1]['respuesta'];

	//////////////////////////////////////////////////////////
	//					Archivos Temporales					//
	//////////////////////////////////////////////////////////

		/**
		*Archivo temporal para el código del profesor
		**/
		$direccionArchivoCodigo = sys_get_temp_dir();
		$archivoTemporal2 = tempnam($direccionArchivoCodigo, "codigo").".txt";
		$gestor2 = fopen($archivoTemporal2, "w");
		fwrite($gestor2, $respuesta[1]['respuesta']);
		fclose($gestor2);
		#echo $archivoTemporal2;

	if (isset($_POST['botonEnviar']) )
	{
		
		#$content = nl2br($valoresTest[1]['valores']);
		#print_r($content);
		
		$descriptorspec =array(
			0 => array("pipe", "r"),  //gestor de lectura conectado al stdin hijo
			1 => array("pipe", "w"),  //gestor de escritura conectado al stdout hijo
			2 => array("pipe", "w")   //gestor de escritura conectado al stderr hijo
		);	
		
		#$process = proc_open('python -c "'.$_POST['texto'].'" < "'.$archivoTemporal.'"', $descriptorspec, $pipes);
		$process = proc_open('python -c "'.$_POST['texto'].'"', $descriptorspec, $pipes);

		if (is_resource($process)) 
		{

			fwrite($pipes[0], $valor);
			fclose($pipes[0]);

			$salida= stream_get_contents($pipes[1]);
			$error = stream_get_contents($pipes[2]);

			if (!is_null($salida)) 
			{
				compararCodigo($salida,$respuesta,$valoresTest,$valor,$archivoTemporal2);
				#print_r($salida);
				print_r($error);
			}#fin if

			fclose($pipes[1]);
			fclose($pipes[2]);		
			$return_value = proc_close($process);

		} #fin if
	}#fin if

	function compararCodigo($salidaEstudiante,$respuesta,$valoresTest,$valor,$archivoTemporal2)
	{
		$descriptorspec =array(
			0 => array("pipe", "r"),  //gestor de escritura conectado al stdin hijo
			1 => array("pipe", "w"),  //gestor de lectura conectado al stdout hijo
		);

			$process = proc_open('python "'.$archivoTemporal2.'"', $descriptorspec, $pipes);

			if (is_resource($process)) 
			{
				fwrite($pipes[0], $valor);
				fclose($pipes[0]);
				
				if ($salidaEstudiante == stream_get_contents($pipes[1]))
				{
					echo "<script> alert('Bien hecho!'); </script>";
				}else {
					echo "<script> alert('verifique su codigo'); </script>";
				}
				fclose($pipes[1]);

				$return_value = proc_close($process);

			}	

	}#fin metodo compararCodigo
	
		/**
		*eliminar archivo temporal valores de prueba
		$nombreFichero = substr($archivoTemporal, 0,-4);
		unlink($nombreFichero);
		unlink($archivoTemporal);
		**/


		/**
		*Eliminar archivo temporal código profesor
		**/
		$nombreFichero2 = substr($archivoTemporal2, 0,-4);
		unlink($nombreFichero2);
		unlink($archivoTemporal2);

	function compilarJava()
	{

		$descriptorspec =array(
			0 => array("pipe", "r"),  //gestor de lectura conectado al stdin hijo
			1 => array("pipe", "w"),  //gestor de escritura conectado al stdout hijo
			2 => array("pipe", "w")   //gestor de escritura conectado al stderr hijo
		);	
		$process = proc_open('./ejava.sh /home/maf/archivo', $descriptorspec, $pipes);

	}
?>
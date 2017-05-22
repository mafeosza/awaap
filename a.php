<?php

	#require "/modelos/RetoModelo.php";
	#require "/modelos/TestModelo.php";
	
	#$reto = new RetoModelo();
	#$test = new TestModelo();

		#$respuesta = $reto->respuestaPython(1);
$respuesta = "hola mundo";
$temp = tmpfile();
fwrite($temp, $respuesta);
fseek($temp, 0);
echo fread($temp, 1024);
fclose($temp); // esto elimina el archivo
?>
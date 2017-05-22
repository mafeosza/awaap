<?php session_start();
	
	require "../modelos/GrupoModelo.php";
	require "../modelos/RetoModelo.php";

	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {

		function nuevo(){
			$grupo = new GrupoModelo();
			$reto = new RetoModelo();

			//id grupo al que pertenece el reto, valor numerico valido
			$idGrupo = isset($_GET['id']) ? (int)$_GET['id'] : false;

			if(!$idGrupo){
				header('Location: ../Index.php');
			}

			$temas = $grupo->temasGrupo($idGrupo);

				/**
				*Comprobar que el usuario envio los datos, 
				*verificando si se enviaron datos por el método post
				*/
				if ($_SERVER['REQUEST_METHOD'] =='POST') {
					//variable que contendra los errores del usuario
					$errores='';

					$imagenDefecto = '';
					$archivoSubido = '';
					//Se guardan los datos ingresados por el usuario en variables
					$titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_STRING);
					$descripcionCorta = filter_var($_POST['descripcionCorta'], FILTER_SANITIZE_STRING);
					$especificaciones = filter_var($_POST['especificaciones'], FILTER_SANITIZE_STRING);
					$nivelDificultad = $_POST['star'];
					$solucionJava = $_POST['solucionJava'];
					$solucionPython = $_POST['solucionPython'];
					$tema = $_POST['tema'];

	#echo $nivelDificultad;

					if(empty($titulo) or empty($descripcionCorta) or empty($especificaciones) or empty($nivelDificultad) or empty($tema))
					{

						$errores .= '<li>Por favor completa todos los datos correctamente</li>';

						if (empty($solucionPython) or empty($solucionJava)) {
							$errores.= '<li>Por favor escribe almenos una soluci&oacute;n</li>';
						}

					}else {

						if (!empty($_FILES) && $_FILES['imagen']['error']==0) {
							
							$check = @getimagesize($_FILES['imagen']['tmp_name']);

							if ($check !== false) {

								$carpetaDestino = '../imagenes/';
								$archivoSubido = $carpetaDestino.$_FILES['imagen']['name'];
								move_uploaded_file($_FILES['imagen']['tmp_name'], $archivoSubido);
								
							}else{
								
								$errores.="<li> El archivo no es una imagen o el archivo es muy pesado </li>"; 
							}

						} else {
							$imagenDefecto = '../imagenes/programar.jpg';
						}

					}
					//Crear nuevo reto
					if(empty($errores))
					{
						if (empty($imagenDefecto)) {
							
							$reto->crearReto($titulo, $descripcionCorta, $especificaciones, $nivelDificultad, $solucionPython, $solucionJava, $tema, $archivoSubido, $idGrupo);
							
						}else{
							$reto->crearReto($titulo, $descripcionCorta, $especificaciones, $nivelDificultad, $solucionPython, $solucionJava, $tema, $imagenDefecto, $idGrupo);
							
						}
						$idReto = $reto->idUltimoReto($idGrupo);
						
						header('Location: ../controladores/TestControlador.php?a=nuevo&id='.$idReto);
	
					}			
				}//end if*/

				require "../vistas/NuevoReto.view.php";
			

		}//end nuevo

		function editar(){
			$grupo = new GrupoModelo();
			$reto = new RetoModelo();

			//id del reto, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;


			$infoReto = $reto->informacionReto($id);
			
			
			$idGrupo = $infoReto[0]['Grupo_id'];
			
			$temas = $grupo->temasGrupo($idGrupo);

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				
				//variable que contendra los errores del usuario
				$errores='';

				//Se guardan los datos ingresados por el usuario en variables
				$titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_STRING);
				$descripcionCorta = filter_var($_POST['descripcionCorta'], FILTER_SANITIZE_STRING);
				$especificaciones = filter_var($_POST['especificaciones'], FILTER_SANITIZE_STRING);
				$nivelDificultad = $_POST['nivelDificultad'];
				$solucionJava = $_POST['solucionJava'];
				$solucionPython = $_POST['solucionPython'];
				$temaGuardado= $_POST['temaGuardado'];
				$tema = $_POST['tema'];
				$imagenGuardada = $_POST['imagenGuardada'];
				$imagen = $_FILES['imagen'];

				if(empty($titulo) or empty($descripcionCorta) or empty($especificaciones) or empty($nivelDificultad) or empty($tema)){

					$errores .= '<li>Por favor completa todos los datos correctamente</li>';

					if (empty($solucionPython) or empty($solucionJava)) {
						$errores.= '<li>Por favor escribe almenos una soluci&oacute;n</li>';
					}

				}else {
					if (!empty($_FILES) && !empty($imagen['name'])) {
						
						$check = @getimagesize($_FILES['imagen']['tmp_name']);

						if ($check !== false) {

							$carpetaDestino = '../imagenes/';
							$archivoSubido = $carpetaDestino.$_FILES['imagen']['name'];
							move_uploaded_file($_FILES['imagen']['tmp_name'], $archivoSubido);
							$imagen = $archivoSubido;
							
						}else{
							
							$errores.="<li> El archivo no es una imagen o el archivo es muy pesado </li>"; 
						}
					} else{
						$imagen = $imagenGuardada;
					}

				}

				//Modificar reto
				if(empty($errores)){
						
					$reto->modificarReto($id, $titulo, $descripcionCorta, $especificaciones, $nivelDificultad, $solucionPython, $solucionJava, $tema, $temaGuardado, $imagen, $idGrupo);

					header('Location: ../controladores/PanelControl.php?id='.$idGrupo);
					
				}
			}//end if
			require "../vistas/EditarReto.view.php";
		}//end editar

		//Método que elimina un reto dado su id
		function borrar(){

			/**
			*$id id del tema
			*Se verifica que se haya enviado un id valido por la url
			* de lo contrario se establece la variable $id con el valor false
			*/
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			//si $id tiene como valor false, se envia al usuario a index
			if(!$id){
				header('Location: ../Index.php');
			}

			$reto = new RetoModelo();

			$reto->eliminarReto($id);
			//require "../controladores/PanelControl.php"
			echo "Reto eliminado";
		}//end borrar
	
		$funcion = $_GET['a'];
		call_user_func($funcion);

	}
	else{
		require "../vistas/Error.php";
	}
?>
<?php session_start();

	require "../modelos/EspacioAcademicoModelo.php";
	require "../modelos/EstudianteModelo.php";
	require "../modelos/ProfesorModelo.php";
	require "../modelos/GrupoModelo.php";
	require "../modelos/RegistroModelo.php";
	require "../modelos/RetoModelo.php";
	require "../modelos/TestModelo.php";
	require "../modelos/TemaModelo.php";
	require "../modelos/UnidadModelo.php";

	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {

		//////////////////////////////////////////////
		//		  Métodos Espacio Académico			//
		//////////////////////////////////////////////

		function crearEspacio()
		{
			$espacioAcademico = new EspacioAcademicoModelo();

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
				$semestre = $_POST['semestre'];
				#$numeroUnidades = $_POST['unidades'];

				//verificar que los campos no esten vacios
				if (empty($nombre) or empty($semestre)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}

				//crear nuevo espacio academico
				if (empty($errores)) {
					$espacioAcademico->crearEspacioAcademico($nombre, $semestre);
					header('Location: ../controladores/InicioAdministrador.php');
					/**if (!empty($numeroUnidades)) {

						$idEspacioAcademico = $espacioAcademico->idUltimoEspacio();

						for ($numero = 1; $numero <= $numeroUnidades; $numero++) { 
							$unidad->crearUnidad($numero, $idEspacioAcademico);
						}
					}*/
				}
			}
			require "../vistas/CrearEspacio.view.php";
		}

		function editarEspacio()
		{
			$espacioAcademico = new EspacioAcademicoModelo();

			//id del espacio academico, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$informacionEspacio = $espacioAcademico->informacionEspacioAcademico($id);

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				
				//variable que contendra los errores del usuario
				$errores='';

				//Se guardan los datos ingresados por el usuario en variables
				$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
				$semestre = $_POST['semestre'];

				//verificar que los campos no esten vacios
				if (empty($nombre) or empty($semestre)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}

				//crear nuevo espacio academico
				if (empty($errores)) {
					$espacioAcademico->modificarEspacioAcademico($id, $nombre, $semestre);
					header('Location: ../controladores/InicioAdministrador.php');
				}
			}

			require "../vistas/EditarEspacio.view.php";
		}

		function eliminarEspacio()
		{
			$espacioAcademico = new EspacioAcademicoModelo();

			//id del espacio academico, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$espacioAcademico->eliminarEspacioAcademico($id);
			header('Location: ../controladores/InicioAdministrador.php');	
			#echo '<script>alert("hola"); </script>';
		}

		function verUnidades()
		{
			$espacioAcademico = new EspacioAcademicoModelo();

			$espaciosAcademicos = $espacioAcademico->listarEspaciosAcademicos();

			$esSeleccionEspacio = false;

			$espaciosOpcion = "";
			foreach ($espaciosAcademicos as $informacionEspacio) {
				$espaciosOpcion.= '<option value="'.$informacionEspacio['id'].'">'.$informacionEspacio['nombre'].'</option>';
			}

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				
				$esSeleccionEspacio = true;

				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$idEspacioAcademico = $_POST['chosen-unique'];
				if (empty($idEspacioAcademico)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}else{
					$informacionEspacio = $espacioAcademico->informacionEspacioAcademico($idEspacioAcademico);
					$nombreEspacio = $informacionEspacio['nombre'];

					$unidadesEspacio = $espacioAcademico->obtenerUnidades($idEspacioAcademico);
					$tablaUnidades = '';
					foreach ($unidadesEspacio as $informacionUnidad) {

						$tablaUnidades.= '<tr><td>'.$informacionUnidad['id'].'</td>
													<td>'.$informacionUnidad['numero'].'</td>
													<td style="text-align: center;"><a data-toggle="tooltip" title="Editar" href="../controladores/UnidadControlador.php?a=editar&id='.$informacionUnidad['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a data-toggle="tooltip" title="Eliminar" href="../controladores/UnidadControlador.php?a=borrar&id='.$informacionUnidad['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a><a data-toggle="tooltip" title="Ver Temas" href="../controladores/AdministradorControlador.php?a=verTemas&id='.$informacionUnidad['id'].'"><i class="fa fa-list-ul" aria-hidden="true"></i></a></td>
												</tr>';
					}
				}
			}

			require "../vistas/UnidadesPorEspacio.view.php"; 
		}

		function verTemas()
		{
			$unidad = new UnidadModelo();
			$tema = new TemaModelo();

			//id de la unidad, valor numerico valido
			$idUnidad = isset($_GET['id']) ? (int)$_GET['id'] : false;

			//unidad y espacio academcio
			$espacioAcademico = $unidad->espacioAcademicoUnidad($idUnidad);
			$informacionUnidad = $unidad->informacionUnidad($idUnidad);

			$titulo = $espacioAcademico['nombre'].' Unidad-'.$informacionUnidad['numero'];
			
			$temas = $unidad->temasUnidad($idUnidad);
			$tablaTemas = '';
			foreach ($temas as $informacionTema) {
				$tablaTemas.='<tr>
								<td>'.$informacionTema['id'].'</td>
								<td>'.$informacionTema['nombre'].'</td>
								<td style="text-align: center;"><a data-toggle="tooltip" title="Editar" href="../controladores/AdministradorControlador.php?a=editarTema&id='.$informacionTema['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a data-toggle="tooltip" title="Eliminar" href="../controladores/AdministradorControlador.php?a=eliminarTema&id='.$informacionTema['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
							  </tr>
							';
			}

			require "../vistas/ListarTemas.view.php";
		}

		function crearTema()
		{
			$tema = new TemaModelo();

			//id de la unidad al que pertenecera el tema, valor numerico valido
			$idUnidad = isset($_GET['id']) ? (int)$_GET['id'] : false;

			if(!$idUnidad){
				header('Location: ../vistas/Error.php');
			}

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';

				$nombre = $_POST['nombre'];

				if (empty($nombre)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}else{
					$tema->crearTema($nombre, $idUnidad);
					if (isset($_POST['crear'])) {
						header('Location: ../controladores/AdministradorControlador.php?a=verTemas&id='.$idUnidad);
					}
				}
			}
			require "../vistas/CrearTema.view.php";
		}

		function editarTema()
		{
			$tema = new TemaModelo();

			//id tema valor numerico valido
			$idTema = isset($_GET['id']) ? (int)$_GET['id'] : false;

			if(!$idTema){
				header('Location: ../vistas/Error.php');
			}

			$informacionTema = $tema->informacionTema($idTema);

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';

				$nombre = $_POST['nombre'];

				if (empty($nombre)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}else{
					$tema->editarTema($nombre, $idTema, $informacionTema['Unidad_id'] );
						header('Location: ../controladores/AdministradorControlador.php?a=verTemas&id='.$informacionTema['Unidad_id']);
				}
			}

			require "../vistas/EditarTema.view.php";
		}

		function eliminarTema()
		{
			$tema = new TemaModelo();

			//id tema valor numerico valido
			$idTema = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$informacionTema = $tema->informacionTema($idTema);

			if(!$idTema){
				header('Location: ../vistas/Error.php');
			}

			$tema->eliminarTema($idTema);
			header('Location: ../controladores/AdministradorControlador.php?a=verTemas&id='.$informacionTema['Unidad_id']);

		}
		//////////////////////////////////////////////
		//		     Métodos Estudiante		  		//
		//////////////////////////////////////////////

		function editarEstudiante()
		{	
			$estudiante = new EstudianteModelo();


			//id del estudiante, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$informacionEstudiante = $estudiante->informacionEstudiante($id);

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {

				$claveEnBd = $estudiante->claveEstudiante($id);
				
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$documento = filter_var($_POST['documento'], FILTER_SANITIZE_STRING);
				$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
				$correo = filter_var($_POST['correo'], FILTER_SANITIZE_STRING);
				$clave = $_POST['clave'];

				
				//Se comprueba que el usuario ingrese todos los datos
				if (empty($nombre) or empty($correo) or empty($documento)) {

					$errores .= '<li>Por favor completa todos los datos correctamente</li>';

				}else{
					
					//Se verifica si se desea cambiar la clave del estudiante
					if (!empty($clave)) {
						//cifrar clave
						$passHash = crypt($clave,"%4lw4y5&c$n!0&");
						
						//Modificacion del estudiante
						$estudiante->modificarEstudiante($id, $documento, $nombre, $correo, $clave);
						header('Location: ../controladores/InicioAdministrador.php');

					}else{
						//Modificacion del estudiante
						$estudiante->modificarEstudiante($id, $documento, $nombre, $correo, $claveEnBd);
						header('Location: ../controladores/InicioAdministrador.php');
					}
				}
			}

			require "../vistas/EditarEstudiante.view.php";
		}

		function eliminarEstudiante()
		{
			$estudiante = new EstudianteModelo();

			//id del estudiante, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$estudiante->eliminarEstudiante($id);
			header('Location: ../controladores/InicioAdministrador.php');	
			#echo '<script>alert("hola"); </script>';
		}

		function registrarEstudiante()
		{
			$estudiante = new EstudianteModelo();
			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
				$email = $_POST['correo'];
				$documento = $_POST['documento'];
				$clave = $_POST['clave'];

				
				//Se comprueba que el usuario ingrese todos los datos
				if (empty($nombre) or empty($email) or empty($documento) or empty($clave)) {

					$errores .= '<li>Por favor completa todos los datos correctamente</li>';

				}else{
					
					//Se verifica que no exista un registro previo del estudiante
					if ($estudiante->verificarEstudiante($documento) != false) {
						$errores.="<li> El usuario ya existe </li>";
					}//end if


					//cifrar clave
					$passHash = crypt($clave,"%4lw4y5&c$n!0&");

				}//end else

				
				//Registro del estudiante
				if (empty($errores)) {
					
					$estudiante->registrarEstudiante($documento, $nombre, $email, $passHash);
					header('Location: ../controladores/InicioAdministrador.php');
				}
			}
			require "../vistas/CrearEstudiante.view.php";
		}

		//////////////////////////////////////////////
		//		     Métodos Profesor		  		//
		//////////////////////////////////////////////

		function editarProfesor()
		{
			$profesor = new ProfesorModelo();

			//id del profesor, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$informacionProfesor = $profesor->informacionProfesor($id);

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {

				$claveEnBd = $profesor->claveProfesor($id);
				
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$documento = filter_var($_POST['documento'], FILTER_SANITIZE_STRING);
				$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
				$correo = filter_var($_POST['correo'], FILTER_SANITIZE_STRING);
				$clave = $_POST['clave'];

				
				//Se comprueba que el usuario ingrese todos los datos
				if (empty($nombre) or empty($correo) or empty($documento)) {

					$errores .= '<li>Por favor completa todos los datos correctamente</li>';

				}else{
					//Se verifica si se desea cambiar la clave del profesor
					if (!empty($clave)) {
						//cifrar clave
						$passHash = crypt($clave,"%4lw4y5&c$n!0&");
						
						//Modificacion del profesor
						$profesor->modificarProfesor($id, $documento, $nombre, $correo, $clave);
						header('Location: ../controladores/InicioAdministrador.php');

					}else{
						//Modificacion del profesor
						$profesor->modificarProfesor($id, $documento, $nombre, $correo, $claveEnBd);
						header('Location: ../controladores/InicioAdministrador.php');
					}
				}
			}
			require "../vistas/EditarProfesor.view.php";
		}

		function eliminarProfesor()
		{
			$profesor = new ProfesorModelo();

			//id del profesor, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$profesor->eliminarProfesor($id);
			header('Location: ../controladores/InicioAdministrador.php');	
			#echo '<script>alert("hola"); </script>';
		}

		function registrarProfesor()
		{
			$profesor = new ProfesorModelo();

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
				$email = $_POST['correo'];
				$documento = $_POST['documento'];
				$clave = $_POST['clave'];

				//Se comprueba que el usuario ingrese todos los datos
				if (empty($nombre) or empty($email) or empty($documento) or empty($clave)) {

					$errores .= '<li>Por favor completa todos los datos correctamente</li>';

				}else{
					
					//Se verifica que no exista un registro previo del profesor
					if ($profesor->verificarProfesor($documento) != false) {
						$errores.="<li> El usuario ya existe </li>";
					}//end if


					//cifrar clave
					$passHash = crypt($clave,"%4lw4y5&c$n!0&");

				}//end else

				//Registro del profesor
				if (empty($errores)) {
					
					$profesor->registrarProfesor($documento, $nombre, $email, $passHash);
					header('Location: ../controladores/InicioAdministrador.php');
				}
			}

			require "../vistas/CrearProfesor.view.php";
		}
		//////////////////////////////////////////////
		//		       Métodos Retos		  		//
		//////////////////////////////////////////////
		function verRetos()
		{
			$profesor = new ProfesorModelo();

			$profesores = $profesor->listarProfesores();

			$esSeleccionProfesor = false;

			$profesoresOpcion = "";
			foreach ($profesores as $informacionProfesor) {
				$profesoresOpcion.= '<option value="'.$informacionProfesor['id'].'">'.$informacionProfesor['nombre'].'</option>';
			}

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				
				$esSeleccionProfesor = true;

				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$idProfesor = $_POST['chosen-unique'];
				if (empty($idProfesor)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}else{
					$informacionProfesor = $profesor->informacionProfesor($idProfesor);
					$nombreProfesor = $informacionProfesor['nombre'];

					$retosProfesor = $profesor->retosProfesor($idProfesor);
					$tablaRetos = '';
					$lenguajes = '';
					foreach ($retosProfesor as $informacionReto) {

						$lenguajes.= !empty($informacionReto['python']) ? '<li>Python</li>' : '';
						$lenguajes.= !empty($informacionReto['java']) ? '<li>Java</li>' : '';

						$tablaRetos.= '<tr><td>'.$informacionReto['espacioAcademico'].'</td>
													<td>'.$informacionReto['nombreTema'].'</td>
													<td>'.$informacionReto['numero'].'-'.$informacionReto['franja'].'</td>
													<td>'.$informacionReto['titulo'].'</td>
													<td>'.$lenguajes.'</td>
													<td style="text-align: center;"><a data-toggle="tooltip" title="Editar" href="../controladores/RetoControlador.php?a=editar&id='.$informacionReto['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a data-toggle="tooltip" title="Eliminar" href="../controladores/RetoControlador.php?a=borrar&id='.$informacionReto['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a><a data-toggle="tooltip" title="Ver Tests Retos" href="../controladores/AdministradorControlador.php?a=verTestsReto&id='.$informacionReto['id'].'"><i class="fa fa-list-ul" aria-hidden="true"></i></a></td>
												</tr>';
						$lenguajes = '';
					}

					$documentoProfesor = $profesor->documentoProfesor($idProfesor);

					$grupos = $profesor->gruposEspaciosAcademicos($documentoProfesor);

					$opcionesGrupos = '';
					foreach ($grupos as $grupo) {
						$opcionesGrupos.='<option value="'.$grupo['id'].'">'.$grupo['numero'].'-'.$grupo['franja'].' '.$grupo['espacioAcademico'].'</option>';
					}
				}
			}

			require "../vistas/RetosPorProfesor.view.php"; 
		}

		function verTestsReto()
		{
			$reto = new RetoModelo();
			$test = new TestModelo();

			//id del reto, valor numerico valido
			$idReto = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$tituloReto = $reto->nombreReto($idReto);

			$tests = $test->informacionTests($idReto);
			$tablaTest = '';
			foreach ($tests as $informacionTest) {
				$visibilidad = $informacionTest['visible'] == 1 ? 'SI' : 'NO';
				$tablaTest.='<tr>
								<td>'.$informacionTest['descripcion'].'</td>
								<td>'.$informacionTest['valores'].'</td>
								<td>'.$visibilidad.'</td>
								<td>'.$informacionTest['lenguaje'].'</td>
								<td style="text-align: center;"><a data-toggle="tooltip" title="Editar" href="../controladores/TestControlador.php?a=editar&id='.$informacionTest['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a data-toggle="tooltip" title="Eliminar" href="../controladores/TestControlador.php?a=borrar&id='.$informacionTest['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
							  </tr>
							';
			}

			require "../vistas/ListarTests.view.php";
		}

		function obtenerTemas()
		{
			$espacioAcademico = new EspacioAcademicoModelo();

			$idEspacioAcademico = explode(" ", $_GET['id']);

			$temas = $espacioAcademico->temasEspacioAcademico($idEspacioAcademico[0]);

			$opcionesTema = '';
			foreach ($temas as $informacionTema) {
				$opcionesTema.= '<option valu="'.$informacionTema['idTema'].'">'.$informacionTema['nombreTema'].'</option>';
			}
			echo json_encode($opcionesTema);
			#echo json_encode($idEspacioAcademico[0]);

		}

		//////////////////////////////////////////////
		//		       Métodos Grupo		  		//
		//////////////////////////////////////////////

		function editarGrupo()
		{	
			$grupo = new GrupoModelo();
			$espacioAcademico = new EspacioAcademicoModelo();
			$profesor = new ProfesorModelo();

			//id del grupo, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$informacionGrupo = $grupo->informacionGrupo($id);
			$espacios = $espacioAcademico->listarEspaciosAcademicos();
			$profesores = $profesor->listarProfesores();
			$espacioAcademicoBD = $informacionGrupo['EspacioAcademico_id'];
			$profesorBD = $informacionGrupo['Profesor_id'];

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$numero = filter_var($_POST['numero'], FILTER_SANITIZE_STRING);
				$franja = $_POST['franja'];
				$espacioAcademicoSelec = $_POST['espacioAcademico'];
				$profesorSelec = $_POST['profesor'];

				if (empty($numero) or empty($franja) or empty($espacioAcademicoSelec) or empty($profesorSelec)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}
				if (empty($errores)) {

					//modificar grupo
					$grupo->modificarGrupo($id, $espacioAcademicoBD, $profesorBD, $numero, $franja, $espacioAcademicoSelec, $profesorSelec);
					header('Location: ../controladores/InicioAdministrador.php');
				}
			}

			require "../vistas/EditarGrupo.view.php";
		}

		function eliminarGrupo()
		{
			$grupo = new GrupoModelo();

			//id del grupo, valor numerico valido
			$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

			$grupo->eliminarGrupo($id);
			header('Location: ../controladores/InicioAdministrador.php');	
			#echo '<script>alert("hola"); </script>';
		}

		function crearGrupo()
		{	
			$grupo = new GrupoModelo();
			$espacioAcademico = new EspacioAcademicoModelo();
			$profesor = new ProfesorModelo();

			$espacios = $espacioAcademico->listarEspaciosAcademicos();
			$profesores = $profesor->listarProfesores();

			/**
			*Comprobar que el usuario envio los datos, 
			*verificando si se enviaron datos por el método post
			*/
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';
				//Se guardan los datos ingresados por el usuario en variables
				$numero = filter_var($_POST['numero'], FILTER_SANITIZE_STRING);
				$franja = $_POST['franja'];
				$espacioAcademicoSelec = $_POST['espacioAcademico'];
				$profesorSelec = $_POST['profesor'];

				if (empty($numero) or empty($franja) or empty($espacioAcademicoSelec) or empty($profesorSelec)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}
				if (empty($errores)) {
					$grupo->crearGrupo($numero, $franja, $espacioAcademicoSelec, $profesorSelec);
					header('Location: ../controladores/InicioAdministrador.php');
				}
			}
			require "../vistas/CrearGrupo.view.php";
		}

		function agregarEstudianteGrupo()
		{	
			$grupo = new GrupoModelo();
			$registro = new RegistroModelo();

			//id del grupo, valor numerico valido
			$idGrupo = isset($_GET['id']) ? (int)$_GET['id'] : false;	
			$informacionGrupo = $grupo->informacionGrupo($idGrupo);

			$informacionDetallesGrupo = $grupo->informacionDetallesGrupo($idGrupo);

			$detalles = $informacionDetallesGrupo['nombreEspacio'].' '.$informacionDetallesGrupo['numero'].'-'.$informacionDetallesGrupo['franja'].' con: '.$informacionDetallesGrupo['nombreProfesor'];

			$tablaEstudiantes = "";
			$estudiantes = $grupo->listarEstudiantes($idGrupo);
			if(!empty($estudiantes)){
				foreach ($estudiantes as $informacionEstudiante) {
					$tablaEstudiantes.= '<tr><td>'.$informacionEstudiante['id'].'</td>
													<td>'.$informacionEstudiante['documento'].'</td>
													<td>'.$informacionEstudiante['nombre'].'</td>
													<td style="text-align: center;"><a data-toggle="tooltip" title="Retirar del grupo" href="../controladores/AdministradorControlador.php?a=eliminarRegistroEstudiante&id='.$informacionEstudiante['id'].'&g='.$idGrupo.'"> <i class="fa fa-times" aria-hidden="true"></i></a></td>
												</tr>';
				}
			}

			$estudiantesOpcion = "";
			$otrosEstudiantes = $grupo->listarOtrosEstudiantes($idGrupo);
			if (!empty($otrosEstudiantes)) {
				foreach ($otrosEstudiantes as $estudiante) {
					$estudiantesOpcion.='<option value="'.$estudiante['id'].'">'.$estudiante['nombre'].'</option>';
				}
			}

			$idProfesor = $informacionGrupo['Profesor_id'];
			if ($_SERVER['REQUEST_METHOD'] =='POST') {
				//variable que contendra los errores del usuario
				$errores='';

				//Se guardan los datos ingresados por el usuario en variables
				$ids = $_POST['chosen-multiple'];

				#print_r($ids);
				if (empty($ids)) {
					$errores .= '<li>Por favor completa todos los datos correctamente</li>';
				}else{
					foreach ($ids as $idEstudiante) {
						$registro->agregarRegistro($idGrupo, $idProfesor, $idEstudiante);
						header('Location: ../controladores/AdministradorControlador.php?a=agregarEstudianteGrupo&id='.$idGrupo);

						#falta mensaje confirmacion o error
					}
				}
			}

			require "../vistas/AgregarEstudianteGrupo.view.php";
		}

		function eliminarRegistroEstudiante()
		{	
			$registro = new RegistroModelo();

			//id del estudiante, valor numerico valido
			$idEstudiante = isset($_GET['id']) ? (int)$_GET['id'] : false;
			//id del grupo, valor numerico valido
			$idGrupo = isset($_GET['g']) ? (int)$_GET['g'] : false;

			$idRegistro = $registro->idRegistro($idGrupo, $idEstudiante);
			$idProfesor = $registro->idProfesor($idRegistro);
			#echo $idRegistro."-".$idGrupo."-".$idProfesor."-".$idEstudiante;
			#die();

			//se realiza la eliminación del registro del estudiante
			$registro->eliminarRegistro($idRegistro, $idGrupo, $idProfesor, $idEstudiante);

			header('Location: ../controladores/AdministradorControlador.php?a=agregarEstudianteGrupo&id='.$idGrupo);

			#falta mensaje
		}

		/*
		*se busca la funcion indicada por url
		*/
		$funcion = $_GET['a'];
		call_user_func($funcion);

	}
	else{
		require "../vistas/Error.php";
	}

?>
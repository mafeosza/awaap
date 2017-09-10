<?php session_start();
	require "../modelos/EspacioAcademicoModelo.php";
	require "../modelos/EstudianteModelo.php";
	require "../modelos/ProfesorModelo.php";
	require "../modelos/GrupoModelo.php";

	/**
	*Entidades a usar
	*/
	$espacioAcademico = new EspacioAcademicoModelo();
	$estudiante = new EstudianteModelo();
	$profesor = new ProfesorModelo();
	$grupo = new GrupoModelo();

	/**
	*variables
	*/
	

	/**
	*Determinar si la sesión está definida 
	*/
	if (isset($_SESSION['documento'])) {

		$espaciosAcademicos = $espacioAcademico->listarEspaciosAcademicos();
		if (!empty($espaciosAcademicos)) {
			$tablaEspaciosAcademicos = "";
			foreach ($espaciosAcademicos as $informacionEspacio) {
				$tablaEspaciosAcademicos.= '<tr><td>'.$informacionEspacio['id'].'</td>
												<td>'.$informacionEspacio['nombre'].'</td>
												<td style="text-align: center;">'.$informacionEspacio['semestre'].'</td>
												<td style="text-align:center"><a href="../controladores/AdministradorControlador.php?a=editarEspacio&id='.$informacionEspacio['id'].'"> <i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="../controladores/AdministradorControlador.php?a=eliminarEspacio&id='.$informacionEspacio['id'].'"> <i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
											</tr>';
			}
		}
		
		$estudiantes = $estudiante->listarEstudiantes();
		if(!empty($estudiantes)){
			$tablaEstudiantes = "";
			foreach ($estudiantes as $informacionEstudiante) {
				$tablaEstudiantes.= '<tr><td>'.$informacionEstudiante['id'].'</td>
												<td>'.$informacionEstudiante['documento'].'</td>
												<td>'.$informacionEstudiante['nombre'].'</td>
												<td>'.$informacionEstudiante['correo'].'</td>
												<td style="text-align: center;"><a href="../controladores/AdministradorControlador.php?a=editarEstudiante&id='.$informacionEstudiante['id'].'"> <i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="../controladores/AdministradorControlador.php?a=eliminarEstudiante&id='.$informacionEstudiante['id'].'"> <i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
											</tr>';
			}
		}

		$profesores = $profesor->listarProfesores();
		if(!empty($profesores)){
			$tablaProfesores = "";
			foreach ($profesores as $informacionProfesores) {
				$tablaProfesores.= '<tr><td>'.$informacionProfesores['id'].'</td>
												<td>'.$informacionProfesores['documento'].'</td>
												<td>'.$informacionProfesores['nombre'].'</td>
												<td>'.$informacionProfesores['correo'].'</td>
												<td style="text-align: center;"><a href="#editar"> <i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="#eliminar"> <i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
											</tr>';
			}
		}

		$grupos = $grupo->listarGrupos();
		if(!empty($profesores)){
			$tablaGrupos = "";
			foreach ($grupos as $informacionGrupos) {
				$tablaGrupos.= '<tr><td>'.$informacionGrupos['id'].'</td>
												<td>'.$informacionGrupos['numero'].'</td>
												<td>'.$informacionGrupos['franja'].'</td>
												<td>'.$informacionGrupos['nombreProfesor'].'</td>
												<td>'.$informacionGrupos['nombreEspacio'].'</td>
												<td style="text-align: center;"><a href="#editar"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="#eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></a><a href="#adduser"><i class="fa fa-user-plus" aria-hidden="true"></i></a></td>
											</tr>';
			}
		}

		require "../vistas/InicioAdministrador.view.php";
	
	}else {
		header('Location: ../Index.php');
	}
?>
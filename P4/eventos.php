<?php
require("twig_load.php");
require_once  __DIR__ . "/models/Evento.php";
require_once  __DIR__ . "/models/Comentario.php";
	$evento = new Evento();
	$comentario = new Comentario();

	session_start();
	$_SESSION['tipoUsuario'] = 2;
	
	if (isset($_GET['imprimir'])) {
		$evento_selecc = $evento->getById($_GET['evento']);

		$template = $twig->load("evento_imprimir.html");
		echo $template->render(['evento' => $evento_selecc]);

	} else if (isset($_POST['nuevo_comentario'])) {
		$nuevoComentario = new Comentario();
		$nuevoComentario->asignarValores($_POST['nombre'], $_POST['email'], $_POST['texto'], $_POST['evento'], '2019-05-2',
																			$_SERVER['REMOTE_ADDR'], 'autor3.jpg');

		$estado;
		$mensaje;
		if ($nuevoComentario->guardar()) {

			$estado = 'ok';
			$mensaje = "Comentario insertado correctamente";

		} else {
			$estado = 'error';
			$mensaje = "Error insertando el comentario";
		}

		$template = $twig->load("error-success.html");
		echo $template->render(['estado' => $estado, 'mensaje' => $mensaje, 'proximosEventos' => $proximosEventos, 'tags' => $tags]);

	}	else if (isset($_GET['evento'])) {
		$evento_selecc = $evento->getById($_GET['evento']);
		$comentarios = $comentario->getComentariosEvento($_GET['evento']);

		$template;
		if ($_GET['evento'] == 6)
			$template = $twig->load("evento_galeria.html");

		else
			$template = $twig->load("mostrar_evento.html");

		echo $template->render(['evento' => $evento_selecc, 'proximosEventos' => $proximosEventos, 'tags' => $tags, 'comentarios' => $comentarios, 'tipoUsuario' => $_SESSION['tipoUsuario']]);

	} else if(isset($_POST['modificar_evento'])){
		// recuperar el eveento con el id
		// llamas plantilla modificar_evento pasandole el evento
		// (en plantilla)
			// envías form aquí
			// compruebas valores
			// vuelves a recuperar evento por id
			// hacer setVariable
			// metodo actualiazar
		$evento_selecc = $evento->getById($_POST['modificar_evento']);
		$template;
		if(!empty($evento_selecc)){
			$template = $twig->load("modificar_evento.html");
		}
		//print_r($evento_selecc);

		echo $template->render(['evento' => $evento_selecc, 'proximosEventos' => $proximosEventos, 'tags' => $tags, 'tipoUsuario' => $_SESSION['tipoUsuario']]);


	} else if(isset($_POST['id_evento_modificado'])){
		$evento_selecc = $evento->getById($_POST['id_evento_modificado']);
		$comentarios = $comentario->getComentariosEvento($_POST['id_evento_modificado']);

		$template;
		
		if(isset($_POST['nombre']) && isset($_POST['organizador']) 
			&& isset($_POST['fecha']) && isset($_POST['descripcion']) && isset($_POST['imagen'])){

				if(!empty($evento_selecc)){		
					$evento->setNombre($_POST['nombre']);
					$evento->setOrganizador($_POST['organizador']);
					$evento->setFecha($_POST['fecha']);
					$evento->setDescripcion($_POST['descripcion']);
					$evento->setImagen($_POST['imagen']);
					$evento->actualizar();

					$template = $twig->load("mostrar_evento.html");
				}
		}

		echo $template->render(['evento' => $evento_selecc, 'proximosEventos' => $proximosEventos, 'comentarios' => $comentarios, 'tags' => $tags, 'tipoUsuario' => $_SESSION['tipoUsuario']]);

	}else {
		header("location:index.php");
	}
?>

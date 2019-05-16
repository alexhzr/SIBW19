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

	} else {
		header("location:index.php");
	}
?>

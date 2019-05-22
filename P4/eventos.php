<?php
require("twig_load.php");
require_once  __DIR__ . "/models/Evento.php";
require_once  __DIR__ . "/models/Comentario.php";
	$evento = new Evento();
	$comentario = new Comentario();

	
	$_SESSION['tipoUsuario'] = 2;
	
	if (isset($_GET['imprimir'])) {
		$evento_selecc = $evento->getById($_GET['evento'], "Evento");

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
		$evento_selecc = $evento->getById($_GET['evento'], "Evento");
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
		$evento_selecc = $evento->getById($_POST['modificar_evento'], "Evento");
		$template;
		if(!empty($evento_selecc)){
			$template = $twig->load("modificar_evento.html");
		}
		//print_r($evento_selecc);

		echo $template->render(['evento' => $evento_selecc, 'proximosEventos' => $proximosEventos, 'tags' => $tags, 'tipoUsuario' => $_SESSION['tipoUsuario']]);


	} else if(isset($_POST['id_evento_modificado'])){
		$evento_selecc = $evento->getById($_POST['id_evento_modificado'], "Evento");
		$comentarios = $comentario->getComentariosEvento($_POST['id_evento_modificado']);

		$template;
		
		if(isset($_POST['nombre']) && isset($_POST['organizador']) 
			&& isset($_POST['fecha']) && isset($_POST['descripcion']) && isset($_POST['imagen'])){

				if(!empty($evento_selecc)){	
					//print_r($_POST['nombre']." " .$_POST['organizador']. " " .$_POST['fecha']. " " .$_POST['descripcion']." ".$_POST['imagen']);

					$evento_selecc->setNombre($_POST['nombre']);
					$evento_selecc->setOrganizador($_POST['organizador']);
					$evento_selecc->setFecha($_POST['fecha']);
					$evento_selecc->setDescripcion($_POST['descripcion']);
					$evento_selecc->setImagen($_POST['imagen']);

					$evento_selecc->actualizar();

					$template = $twig->load("mostrar_evento.html");
				}
		}

		echo $template->render(['evento' => $evento_selecc, 'proximosEventos' => $proximosEventos, 'comentarios' => $comentarios, 'tags' => $tags, 'tipoUsuario' => $_SESSION['tipoUsuario']]);
		

	}else if(isset($_POST['borrar_evento'])){
		$evento_selecc = $evento->getById($_POST['borrar_evento'], "Evento");
		$template;

		if(!empty($evento_selecc)){
			$evento_selecc->deleteById($_POST['borrar_evento']);
			header("location:index.php");
		}
	}else {
		header("location:index.php");
	}
?>

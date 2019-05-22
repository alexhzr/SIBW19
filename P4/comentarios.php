<?php
    require("twig_load.php");
    require("comprobaciones.php");
	ini_set('display_errors', 1);
    error_reporting(-1);

    // si el usuario está logueado y tiene permisos
	if (isset($_SESSION['tipoUsuario'])) {
        if ($_SESSION['tipoUsuario'] >= 1) {
            $comentario = new Comentario();

            // aquí envío la plantilla para modificar un comentario
            if (isset($_POST['id_modificar'])) {
                $comentario_plantilla = $comentario->getById($_POST['id_modificar'], "Comentario");
                $template = $twig->load("modificar_comentario.html");
                echo $template->render(['comentario' => $comentario_plantilla, 'proximosEventos' => $proximosEventos, 'tags' => $tags]);

            // si me llegan los datos del formulario para modificar
            } else if (isset($_POST['modificarComentarioSubmit'])) {
                if (comprobar_valores_mod_comentario($_POST)) {
                    
                    $comentario_modificar = $comentario->getById($_POST['id'], "Comentario");

                    $comentario_modificar->setAutor($_POST['autor']);
                    $comentario_modificar->setEmail($_POST['email']);
                    $comentario_modificar->setTexto($_POST['texto']." - 'Comentario modificado por el moderador.'");

                    if ($comentario_modificar->actualizar()) {
                        header("Location: comentarios.php");
                    } else {
                        $template = $twig->load("error-success.html");
                        echo $template->render(['estado' => 'error', 'mensaje' => 'Error editando el comentario.']);
                    }

                }

            // si me llega para borrar un comentario
            } else if (isset($_POST['id_borrar'])) {
                if (!$comentario->deleteById($_POST['id_borrar'])) {
                    header("Location: comentarios.php");
                } else {
                    $template = $twig->load("error-success.html");
                    echo $template->render(['estado' => 'error', 'mensaje' => 'Error borrando el comentario.']);
                }
            //verá el listado de comentarios
            } else {            
            $template = $twig->load("listado_comentarios.html");
            echo $template->render(['comentarios' => $comentario->getAll(), 'proximosEventos' => $proximosEventos, 'tags' => $tags]);
            }
            
        // usuario sin permisos pa su casa
        } else
            print("usuario sin permisos");
            //header("Location: index.php");
		
    
    } else 
        print("usuario sin identificar");
		//header("Location: index.php");

?>

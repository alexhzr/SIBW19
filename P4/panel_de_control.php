<?php
    require("twig_load.php");
    require("comprobaciones.php");

    // si no está logueado, se le devuelve al index
    if (isset($_SESSION['login'])) {

        // si ha mandado el formulario de modificar, proceso datos
        if (isset($_POST['modificarDatos'])) {
        

        // muestro el formulario de modificación
        } else {
            $usuarios = new Usuario();
            $misdatos = $usuarios->getById($_SESSION['id'], "Usuario");

            $template = $twig->load("paneldecontrol.html");
            echo $template->render(['misdatos' => $misdatos, 'tags' => $tags, 'proximosEventos' => $proximosEventos]);
        }
    } else {
        header("Location: index.php");
    }
?>
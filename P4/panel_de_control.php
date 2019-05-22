<?php
    require("twig_load.php");
    require("comprobaciones.php");

    // si no está logueado, se le devuelve al index
    if (isset($_SESSION['login'])) {
            $usuarios = new Usuario();
            $misdatos = $usuarios->getById($_SESSION['id'], "Usuario");

            $template = $twig->load("paneldecontrol.html");
            echo $template->render(['misdatos' => $misdatos, 'tags' => $tags, 'proximosEventos' => $proximosEventos]);
    } else {
        header("Location: index.php");
    }
?>
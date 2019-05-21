<?php
    require("twig_load.php");
    require("comprobaciones.php");

    if (isset($_SESSION['usuario'])) {
        header("location:index.php");

    } else if (isset($_POST['formularioLogin'])) {
        if (comprobar_valores_login($_POST)) {
            
            $usuario = new Usuario();
            $usuario->existeUsuario($_POST['login'], $_POST['password']);
        } else {
            $template = $twig->load("error-success.html");
            echo $template->render(["estado"=>"error", "mensaje"=>"Revisa los datos y vuelve a intentarlo"]);
        }

    } else {
        $template = $twig->load("login.html");
        echo $template->render([]);   
    }
?>

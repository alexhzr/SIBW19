<?php
    require("twig_load.php");
    require("comprobaciones.php");

    if (isset($_SESSION['login'])) {
        header("location:index.php");

    } else if (isset($_POST['formularioRegistro'])) {
        $usuario = new Usuario();

        if (comprobar_valores_registro($_POST)) {
            
            $usuarios = new Usuario();
            if ($usuario->nickLibre($_POST['login'])) {
                $usuario->setNombre($_POST['nombre']);
                $usuario->setLogin($_POST['login']);
                $usuario->setPassword($_POST['password']);

                if ($usuario->guardar()) {
                    $template = $twig->load("error-success.html");
                    echo $template->render(["estado"=>"ok", "mensaje"=>"Registrado correctamente. Ahora puedes iniciar sesión."]);
                } else {
                    $template = $twig->load("error-success.html");
                    echo $template->render(["estado"=>"error", "mensaje"=>"Error en el registro."]);
                }
            } else {
                $template = $twig->load("error-success.html");
                echo $template->render(["estado"=>"error", "mensaje"=>"Ese nick ya está en uso"]);
            }

        } else {
            $template = $twig->load("error-success.html");
            echo $template->render(["estado"=>"error", "mensaje"=>"Revisa los datos y vuelve a intentarlo"]);
        }

    } else {
        $template = $twig->load("registrar.html");
        echo $template->render([]);   
    }
?>

<?php
    require("twig_load.php");
    require("comprobaciones.php");

    if (isset($_SESSION['login'])) {
        header("location:index.php");

    } else if (isset($_POST['formularioLogin'])) {
        if (comprobar_valores_login($_POST)) {
            
            $usuarios = new Usuario();
            $resultado = $usuarios->existeUsuario($_POST['login'], $_POST['password']);

            // si existe el usuario y tiene su contraseña correcta
            if (is_a($resultado, "Usuario")) {
                
                $_SESSION['login'] = $resultado->getLogin();
                $_SESSION['nombre'] = $resultado->getNombre();
                $_SESSION['tipoUsuario'] = $resultado->getTipoUsuario();
                $_SESSION['id'] = $resultado->getId();

                
                $template = $twig->load("error-success.html");
                echo $template->render(["estado"=>"ok", "mensaje"=>"Login correcto", "session"=>$_SESSION]);

            // no existe ese usuario
            } if ($resultado == 0) {
                $template = $twig->load("error-success.html");
                echo $template->render(["estado"=>"error", "mensaje"=>"Usuario no existe"]);

            // contraseña incorrecta
            } else if ($resultado == -1) {
                $template = $twig->load("error-success.html");
                echo $template->render(["estado"=>"error", "mensaje"=>"Contraseña errónea"]);
            
            // login correcto
            } else {
                session_start();
                
                $_SESSION['login'] = $resultado->getLogin();
                $_SESSION['nombre'] = $resultado->getNombre();
                $_SESSION['tipoUsuario'] = $resultado->getTipoUsuario();

                //print_r($_SESSION);
                $template = $twig->load("error-success.html");
                echo $template->render(["estado"=>"ok", "mensaje"=>"Login correcto"]);
            }
        } else {
            $template = $twig->load("error-success.html");
            echo $template->render(["estado"=>"error", "mensaje"=>"Revisa los datos y vuelve a intentarlo"]);
        }

    } else {
        $template = $twig->load("login.html");
        echo $template->render([]);   
    }
?>

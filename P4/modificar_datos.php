<?php
    require("twig_load.php");
    require("comprobaciones.php");


    // si el usuario está logueado...
    if (isset($_SESSION['login'])) {
        $usuario = new Usuario();

        $template = $twig->load("modificar_datos.html");

        // si no eres admin, sólo te modificas a ti
        if ($_SESSION['tipoUsuario'] < 3 && !isset($_POST['modificarDatosSubmit'])) 
            echo $template->render(['usuario' => $_SESSION, 'proximosEventos' => $proximosEventos, 'tags' => $tags]);
        
        else {

            // si te llega un usuario a modificar, mandas la plantilla rellena
            if (isset($_POST['id_modificar'])) {
                
                $usuario_modificar = $usuario->getById($_POST['id_modificar'], "Usuario");
                echo $template->render(['usuario' => $usuario_modificar, 'proximosEventos' => $proximosEventos, 'tags' => $tags]);
            
            // si llegan los datos para hacer la modificación
            } else if (isset($_POST['modificarDatosSubmit'])) {

                // compruebo los valores primero
                if (comprobar_valores_mod_usuario($_POST)) {
                    $usuario_a_modificar = $usuario->getById($_POST['id'], "Usuario");

                    $usuario_a_modificar->setNombre($_POST['nombre']);
                    $usuario_a_modificar->setLogin($_POST['login']);
                    
                    if ($_POST['tipoUsuario'] != 100)
                        $usuario_a_modificar->setTipoUsuario($_POST['tipoUsuario']);

                    if (!empty($_POST['password'])) 
                        $usuario_a_modificar->setPassword($_POST['password']);

                    if ($usuario_a_modificar->actualizar()) {
                        $template = $twig->load("error-success.html");
                        $_SESSION['nombre'] = $_POST['nombre'];
                        $_SESSION['login'] = $_POST['login'];                        
                        echo $template->render(['estado' => "ok", 'mensaje' => "Datos modificados correctamente."]);
                    } else {
                        $template = $twig->load("error-success.html");
                        echo $template->render(['estado' => "error", 'mensaje' => "Error modificando usuario."]);
                    }
                    
                
                } else {
                    $template = $twig->load("error-success.html");
                    echo $template->render(['estado' => "error", 'mensaje' => "Los datos del formulario son erróneos. Revísalos de nuevo."]);
                }
                

            // si no, muestro el listado
            } else {
                $usuarios = $usuario->getAll();
                $template = $twig->load("listado_usuarios.html");
                echo $template->render(['usuarios' => $usuarios, 'proximosEventos' => $proximosEventos, 'tags' => $tags]);
            }
        }
/*

        // si está el id del usuario a modificar, saco sus datos y envío la plantilla para modificar
        if (isset($_POST['id_modificar'])) {


            
            else {
                $usuario = new Usuario();
                $usuario_modificar = $usuario->getById($_POST['id_modificar'], "Usuario");
                $template = $twig->load("modificar_datos.html");
                echo $template->render(['misdatos' => $misdatos, 'tags' => $tags, 'proximosEventos' => $proximosEventos]);
            }


        // si me llega el formulario de modificar datos, hago las modificaciones
        } else if (isset($_POST['modificarDatosSubmit'])) {
            

        // si no, muestro el listado de usuarios
        } else {

        }
        */
    // si no, pa su casa
    } else {
        header("Location: index.php");
    }
?>
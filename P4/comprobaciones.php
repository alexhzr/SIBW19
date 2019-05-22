<?php
    // Comprobación para el formulario login de login.php
    function comprobar_valores_login($array) {

        if (isset($array['login']) && isset($array['password'])) 
            if (!empty($array['login']) && !empty($array['password'])) 
                return true;
            else
                return false;
        
        else 
            return false;
        
    }

    // Comprobación para el formulario de registro en registro.php
    function comprobar_valores_registro($array) {
        if (isset($array['login']) && isset($array['password']) && isset($array['nombre'])) 
            if (!empty($array['login']) && !empty($array['password']) && !empty($array['nombre'])) 
                return true;
            else
                return false;
    
        else 
            return false;
    }

    // Comprobación para el formulario de modificación en modificar_usuario.php
    function comprobar_valores_mod_usuario($array) {
        if (isset($array['id']) && isset($array['nombre']) && isset($array['login'])) 
            if (!empty($array['login']) && !empty($array['nombre']) && !empty($array['id'])) 
                return true;

            else
                return false;
        else
            return false;
    }

    // Comprobación para el formulario de modificación de comentarios.php
    function comprobar_valores_mod_comentario($array) {
        if (isset($array['id']) && isset($array['autor']) && isset($array['email']) && isset($array['texto'])) 
            if (!empty($array['id']) && !empty($array['autor']) && !empty($array['email']) && !empty($array['texto'])) 
                return true;
            else
                return false;
        else
            return false;
    }
?>
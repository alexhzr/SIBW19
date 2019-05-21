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
?>
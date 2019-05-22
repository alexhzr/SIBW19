<?php
    session_start();

    unset($_SESSION['usuario']);
    unset($_SESSION['login']);
    unset($_SESSION['tipoUsuario']);
    session_destroy();

    header("Location: index.php");
?>
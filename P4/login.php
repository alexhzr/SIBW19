<?php
	require("twig_load.php");

    if (isset($_SESSION['usuario'])) {
        header("location:index.php");
    } else {
        $template = $twig->load("login.html");
        echo $template->render([]);   
    }
?>

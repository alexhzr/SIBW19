<?php
require("twig_load.php");
require_once  __DIR__ . "/models/Evento.php";
	$evento = new Evento();

	if (isset($_GET['evento'])) {
		$evento_selecc = $evento->getById($_GET['evento']);
		$proximosEventos = $evento->getProximosEventos();

		$template = $twig->load("mostrar_evento.html");
		echo $template->render(['evento' => $evento_selecc, 'proximosEventos' => $proximosEventos]);
	}
?>

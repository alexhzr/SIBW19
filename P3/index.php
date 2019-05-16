<?php
	require("twig_load.php");
	$eventos;

	if (isset($_GET['tag'])) {
		$eventos = $evento->getEventosPorTag($_GET['tag']);

	} else {
		$eventos = $evento->getAll();
	}

	$template = $twig->load("eventos.html");
	echo $template->render(['eventos' => $eventos, 'proximosEventos' => $proximosEventos, 'tags' => $tags]);
?>

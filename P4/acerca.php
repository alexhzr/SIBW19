<?php
  require("twig_load.php");
  require_once  __DIR__ . "/models/Evento.php";
	require_once  __DIR__ . "/models/Comunicado.php";


	$comunicado = new Comunicado();
  $evento = new Evento();

  $infoNosotros = $comunicado->getById(1);
	$proximosEventos = $evento->getAll();

	$template = $twig->load("mostrar_comunicado.html");
	echo $template->render(['comunicado' => $infoNosotros, 'proximosEventos' => $proximosEventos, 'tags' => $tags]);
?>

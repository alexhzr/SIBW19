<?php
  define('BASE_PATH', dirname(realpath(__FILE__)) . '/');
  define('VIEW_PATH', BASE_PATH . 'views/');
  require_once BASE_PATH.'vendor/autoload.php';
  require_once  __DIR__ . "/models/Evento.php";
  require_once  __DIR__ . "/models/Tag.php";

  $evento = new Evento();
  $tag = new Tag();
  $proximosEventos = $evento->getAll();
  $tags = $tag->getAll();

	$loader = new Twig_Loader_Filesystem(VIEW_PATH);
	$twig = new Twig_Environment($loader, array(
					'cache'	=>	BASE_PATH.'cache',
					'debug'	=>	true,
			  'auto_reload'	=>	true,
		 'strict_variables'	=>	true,
			   'autoescape'	=>	true,

	));


?>

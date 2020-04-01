<?php

require 'config/config.php';
require 'app/core/Core.php';
require 'vendor/autoload.php';
date_default_timezone_set("America/Cuiaba");

session_start();
$core = new Core;
$core->run();

/*
	echo "contoller: " .$core->getController();
	echo "<br>Método : " .$core->getMetodo();
	$parametros = $core->getParametros();
	foreach ($parametros as $param)
    echo "<br>Parâmetro : " .$param;
	
	*/


<?php

// Fichier contenant toutes les définitions de constantes et require des fichiers nécessaires au fonctionnement du MVC

define('ROOT', '');
define('CORE', ROOT.'core/');
define('CNTR', ROOT.'controllers/');
define('MODS', ROOT.'models/');
define('SRC', ROOT.'src/');
define('JS', SRC.'js/');
define('IMG', SRC.'img/');
define('CSS', SRC.'css/');

require_once CORE.'autoloader.php';

?>
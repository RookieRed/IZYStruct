<?php

require_once 'core/includes.php';

// Exécution du routeur
$router = new Router();

/*----------------------------------------------------
	Affichage de la page
-------------------------------------------------*/?>

<!DOCTYPE html>
<html>
<head>
	<title><?= $router->getPageTitle(); ?></title>
	<?php $router->includeCSS(); ?>
</head>
<body>

	<?php $router->displayMessages(); ?> 
	<?php $router->displayContent(); ?> 

<?php $router->includeJS(); ?>
</body>
</html>
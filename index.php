<?php

require_once 'core/includes.php';

// Connexion à labase de données
Database::instantiate();

// Instanciation du routeur
$app = new Application();

/*----------------------------------------------------
	Affichage de la page
-------------------------------------------------*/?>

<!DOCTYPE html>
<html>
<head>
	<title><?= $app->getPageTitle(); ?></title>
	<?php $app->includeCSS(); ?>
</head>
<body>

	<?php $app->displayMessages(); ?> 
	<?php $app->displayContent(); ?> 

<?php $app->includeJS(); ?>
</body>
</html>
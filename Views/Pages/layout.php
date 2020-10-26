<?php

/**
 * @var string $content Contenu du corps de la page
 */

use Controllers\Application;
use Controllers\Parts\Alert;

Application::SetAlert(new Alert(Alert::$Error, "coucou"));
Application::SetAlert(new Alert(Alert::$Success, "coucou"));
Application::SetAlert(new Alert(Alert::$Warning, "coucou"));

?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= Application::Instance()->title; ?></title>

	<link href="<?= Application::Instance()->Css; ?>" rel="stylesheet" media="screen">

    <?php if(Application::AnyAlert()): ?>
    <script src="<?=Application::Instance()->Javascript("jquery-3.3.1.slim.min"); ?>" defer></script>
    <script src="<?= Application::Instance()->Javascript("bootstrap.min"); ?>" defer></script>
    <?php endif; ?>
</head>

<body>

    <?php
    foreach (Application::GetAlerts() as $alert){
        $alert->Display();
    }

    require_once Application::Instance()->Navbar;

    if (!empty($_SESSION))
        require_once Application::Instance()->Menu;
?>

<?= $content; ?>

</body>
</html>

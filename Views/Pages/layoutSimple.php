<?php

/**
 * @var string $content Contenu du corps de la page
 */

use Controllers\Application;

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= Application::Instance()->title; ?></title>

    <link href="<?= Application::Instance()->Css; ?>" rel="stylesheet" media="screen">
</head>

<body>

<?= $content; ?>

</body>
</html>

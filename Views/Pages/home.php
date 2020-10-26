<?php

/**
 * @var $coucou
 */

use Controllers\Parts\Boxes\FinishedBox;
use Controllers\Parts\ListDropDown;

?>

<?php if (!empty($_SESSION)) : ?>
    <p align="center">
        Bienvenue <?= $_SESSION['Nom'].' '.$_SESSION['Prenom'] ?>, vous êtes maintenant connecté.
    </p>

    <?php else: ?>
    <h1 align="center">Bienvue sur notre site.</h1>
    <p align="center">Commencez par vous inscrire ;)</p>
    <?php endif; ?>

<br>
<?php (new ListDropDown())->Elements(array("a" => "b")); ?>

<?php (new FinishedBox("a", "b", "c"))->Display(); ?>





<?php

/**
 * @var $coucou
 */

use Controllers\Parts\Boxes\FinishedBox;
use Controllers\Parts\ListDropDown;

?>

<?php
    if (!empty($_SESSION))
    {
        echo '<p align="center">Bienvue '. $_SESSION['Nom'].' '.$_SESSION['Prenom'].', vous êtes maintenant connecté.</p>';
    }
    else
    {
        echo '<h1 align="center">Bienvue sur notre site.</h1>
              <p align="center">Commencez par vous inscrire ;)</p>';

    }
?>
<br>
<?php (new ListDropDown())->Elements(array("a" => "b")); ?>

<?php (new FinishedBox("a", "b", "c"))->Display(); ?>



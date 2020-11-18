<?php

/**
 * @var $taches
 */


use Controllers\Parts\Boxes\BaseBox;
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

<?php foreach ($taches as $tache){
	(new BaseBox($tache->Titre, $tache->Contenu, $tache->DateModif, $tache->Status))->Display();
}
?>


<?php

/**
 * @var array $clientsList Liste des clients
 * @var array $travailleursList Liste des travailleurs
 */

use Controllers\Application;
use Controllers\Parts\ListDropDown;
?>
<p style="/*max-width: 30rem;*/text-align: center; margin: 50px 0 50px 0; font-size: xx-large ">
    Ajout d'une tâche
</p>
<form method="post" action="<?= Application::Instance()->Link("ControlPanel", "AjoutTache",
	array("Controller" => "ControlPanel", "Action" => "LstPersonnes")); ?>" style="max-width: 30rem; margin: auto;">
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Titre :</label>
        <input name="Titre" class="form-control form-control-lg" type="text" placeholder="Titre" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Contenu :</label>
        <input name="Contenu" class="form-control form-control-lg" type="text" placeholder="Contenu" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Status :</label>
        <input name="Status" class="form-control form-control-lg" type="text" placeholder="Status" id="inputLarge">
    </div>

    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Client :</label>
		<?php (new ListDropDown("Client"))->Elements($clientsList); ?>
    </div>

    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Travailleur :</label>
		<?php (new ListDropDown("Travailleur"))->Elements($travailleursList); ?>
    </div>

    <button type="submit" class="btn btn-primary" name="register" style="margin: 20px auto;">Ajouter</button>
</form>

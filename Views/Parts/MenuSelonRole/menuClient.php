<?php use Controllers\Application; ?>

<a href="<?php echo Application::Instance()->Link("ControlPanel", "LstTravailleurs") ?>">
	<button type="button" class="btn btn-primary">Liste des travailleurs</button>
</a>
<a href="<?php echo Application::Instance()->Link("ControlPanel", "LstTaches") ?>">
	<button type="button" class="btn btn-primary">Liste des tâches</button>
</a>
<a href="<?php echo Application::Instance()->Link("ControlPanel", "AjouterTache") ?>">
	<button type="button" class="btn btn-primary">Ajouter une tâche</button>
</a>
<?php

use Controllers\Application;

?>
<div class="btn-group">
    <a href="<?php echo Application::Instance()->Link("ControlPanel", "LstPersonnes") ?>">
        <button type="button" class="btn btn-primary">Liste des personnes</button>
    </a>
    <a href="<?php echo Application::Instance()->Link("ControlPanel", "LstClients") ?>">
    <button type="button" class="btn btn-primary">Liste des clients</button>
    </a>
    <a href="<?php echo Application::Instance()->Link("ControlPanel", "LstTravailleurs") ?>">
    <button type="button" class="btn btn-primary">Liste des travailleurs</button>
    </a>
    <a href="<?php echo Application::Instance()->Link("ControlPanel", "LstTaches") ?>">
    <button type="button" class="btn btn-primary">Liste des tâches</button>
    </a>
    <a href="<?php echo Application::Instance()->Link("ControlPanel", "AjouterTache") ?>">
    <button type="button" class="btn btn-primary">Ajouter une tâche</button>
    </a>
    <button type="button" class="btn btn-primary">Button</button>
</div>
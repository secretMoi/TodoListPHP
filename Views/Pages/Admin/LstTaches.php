<?php

use \Controllers\Parts\Boxes\BaseBox;
/**
 * @var $variables
 */

    if (!empty($variables)): ?>
        <div style="margin: 50px auto"></div>
        <?php foreach ($variables as $tache)
            (new BaseBox($tache->Titre, $tache->Contenu, $tache->DateModif, $tache->Status))->Display();

    else: ?>
        <div style="text-align: center;">
            <p class="align-content-center">
                Il n'y a pas de client encodé.
            </p>
        </div>
<?php endif; ?>
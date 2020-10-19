<?php

use \Controllers\Parts\Boxes\BaseBox;
/**
 * @var $variables
 */

    if (!empty($variables)) {
        /**echo '<table class="table"><thead><tr><th>ID</th><th>Titre</th><th>Contenu</th><th>Date de création</th><th>Date de modification</th><th>Status</th></tr></thead>';
        echo '<tbody>';
        foreach ($variables as $tache) {
            echo '<tr class="table-active">';
            echo '<td>' . $tache->ID . '</td>';
            echo '<td>' . $tache->Titre . '</td>';
            echo '<td>' . $tache->Contenu . '</td>';
            echo '<td>' . $tache->DateCreation . '</td>';
            echo '<td>' . $tache->DateModif . '</td>';
            echo '<td>' . $tache->Status . '</td>';
            echo '</tr>';
        }
        echo '</tbody</table>';*/
        echo '<div style="margin: 50px auto"></div>';
        foreach ($variables as $tache)
        {
            (new BaseBox($tache->Titre, $tache->Contenu, $tache->DateModif, $tache->Status))->Display();
        }
    }
    else
        echo '<center><p class="align-content-center">Il n\'y a pas de client encodé.</p></center>';


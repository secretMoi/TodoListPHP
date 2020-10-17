<?php
/**
 * @var $variables
 */

    if (!empty($variables)) {
        echo '<table class="table"><thead><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Rôle</th></tr></thead>';
        echo '<tbody>';
        foreach ($variables as $personne) {
            echo '<tr class="table-active">';
            echo '<td>' . $personne->ID . '</td>';
            echo '<td>' . $personne->Nom . '</td>';
            echo '<td>' . $personne->Prenom . '</td>';
            echo '<td>' . $personne->AdresseMail . '</td>';
            echo '<td>' . $personne->Role . '</td>';
            echo '</tr>';
        }
        echo '</tbody</table>';
    }
    else
        echo '<center><p>Il n\'y a pas de travailleur encodé.</p></center>';
?>

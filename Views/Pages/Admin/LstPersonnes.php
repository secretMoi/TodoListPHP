<?php
/**
 * @var $variables
 */

    if (!empty($variables)) {
        echo '<table class="table" style="margin: 50px auto"><thead><tr><th>ID</th><th>Nom</th><th>Prénom</th>
                                    <th>Email</th><th>Rôle</th><th>Actions</th></tr></thead>';
        echo '<tbody>';
        foreach ($variables as $personne) {
            echo '<tr class="table-active">';
            echo '<td>' . $personne->ID . '</td>';
            echo '<td>' . $personne->Nom . '</td>';
            echo '<td>' . $personne->Prenom . '</td>';
            echo '<td>' . $personne->AdresseMail . '</td>';
            echo '<td>' . $personne->Role . '</td>';
            echo '<td><a class="btn btn-info" href="Clients/updateClient.php?ID='. $personne->ID .'">Modifier</a>
                      <a class="btn btn-danger" href="Clients/deleteClient.php?ID='. $personne->ID .'">Supprimer</a>';
            echo '</tr>';
        }
        echo '</tbody</table>';
    }
    else
        echo '<center><p class="align-content-center" style="margin: 50px auto">Il n\'y a pas personne d\'encodé.</p></center>';
?>

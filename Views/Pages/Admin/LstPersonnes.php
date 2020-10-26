<?php
/**
 * @var $variables
 */

use Controllers\Application;

if (!empty($variables)): ?>
<table class="table" style="margin: 50px auto">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Email</th>
			<th>Rôle</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
        <?php foreach ($variables as $personne): ?>

        <tr class="table-active">
	        <td><?= $personne->ID; ?></td>
	        <td><?= $personne->Nom; ?></td>
	        <td><?= $personne->Prenom; ?></td>
	        <td><?= $personne->AdresseMail; ?></td>
	        <td><?= $personne->Role; ?></td>

	        <td>
		        <a class="btn btn-info"
                   href="<?= Application::Instance()->Link("Personne", "UpdateView",
                       array("ID" => $personne->ID
                       )); ?>">
                    Modifier
                </a>
		        <a class="btn btn-danger"
                   href="<?= Application::Instance()->Link("Personne", "Delete",
                       array("ID" => $personne->ID,
	                       "Controller" => "Personne",
	                       "Action" => "LstPersonnes"
                       )); ?>">
                    Supprimer
                </a>
	        </td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
		<div style="text-align: center;">
            <p class="align-content-center" style="margin: 50px auto">
                Il n\'y a personne d'encodé.
            </p>
        </div>
<?php endif; ?>


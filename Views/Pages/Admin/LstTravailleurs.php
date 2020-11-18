<?php
/**
 * @var $variables
 */

    if (!empty($variables)): ?>
        <table class="table" style="margin: 50px auto">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
            </tr>
            </thead>

            <tbody>

            <?php foreach ($variables as $personne): ?>
            <tr class="table-active">
            <td><?= $personne->Nom ?></td>
            <td><?= $personne->Prenom ?></td>
            <td><?= $personne->AdresseMail ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    <?php else: ?>
        <div style="text-align: center;">
            <p style="margin: 50px auto">
                Il n'y a pas de travailleur encodé.
            </p>
        </div>
<?php endif;
?>

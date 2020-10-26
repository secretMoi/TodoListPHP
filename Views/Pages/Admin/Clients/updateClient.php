<?php

/**
 * @var Personnes $Personne Model du client à modifier
 */

use Controllers\Application;
use Models\Personnes;

?>
<p style="/*max-width: 30rem;*/text-align: center; margin: 100px 0 50px 0; font-size: xx-large ">
    Modifier un client
</p>
<form method="post" action="<?= Application::Instance()->Link("Client", "Update"); ?>" style="max-width: 30rem; margin: auto;">
    <div class="form-group">
        <input name="ID" class="form-control form-control-lg" type="hidden" value="<?php echo $Personne->ID; ?>" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Nom :</label>
        <input name="Nom" class="form-control form-control-lg" type="text" value="<?php echo $Personne->Nom; ?>" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Prénom :</label>
        <input name="Prenom" class="form-control form-control-lg" type="text" value="<?php echo $Personne->Prenom; ?>" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Adresse mail :</label>
        <input name="AdresseMail" class="form-control form-control-lg" type="text" value="<?php echo $Personne->AdresseMail; ?>" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Modifier mot de passe :</label>
        <input name="MotDePasse" class="form-control form-control-lg" type="password" value="<?php echo $Personne->MotDePasse; ?>" id="inputLarge">
    </div>
    <div class="form-group">
        <input name="Role" class="form-control form-control-lg" type="hidden" value="<?php echo $Personne->Role; ?>" id="inputLarge">
    </div>
    <button type="submit" class="btn btn-primary" name="register" style="margin: 20px auto;">Modifier</button>
</form>

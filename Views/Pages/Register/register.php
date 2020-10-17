<?php

use Controllers\Application;

?>
    <p style="/*max-width: 30rem;*/text-align: center; margin: 100px 0 50px 0; font-size: xx-large ">
    Formulaire d'inscription
</p>
<form method="post" action="<?= Application::Instance()->Link("Register", "Add"); ?>" style="max-width: 30rem; margin: auto;">
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Nom :</label>
        <input name="Nom" class="form-control form-control-lg" type="text" placeholder="Nom" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Prénom :</label>
        <input name="Prenom" class="form-control form-control-lg" type="text" placeholder="Prénom" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Adresse mail :</label>
        <input name="AdresseMail" class="form-control form-control-lg" type="text" placeholder="Adresse mail" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Mot de passe :</label>
        <input name="MotDePasse" class="form-control form-control-lg" type="password" placeholder="Mot de passe" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Confirmer mot de passe :</label>
        <input name="conf_MotDePasse" class="form-control form-control-lg" type="password" placeholder="Confirmer" id="inputLarge">
    </div>
    <button type="submit" class="btn btn-primary" name="register" style="margin: 20px auto;">S'inscrire</button>
</form>



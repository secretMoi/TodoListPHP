<?php

use Controllers\Application;
use Controllers\Database\RequestBuilder;
use Controllers\Database\RequestExecuter;
use Models\Personnes;

$Client = "";

if (!empty($_GET['ID']))
    {
        // récupère le client
        $clientRequest = new RequestBuilder();
        $clientRequest->Select("*")
            ->From(Personnes::class)
            ->Where("ID", $_GET['ID']);
        $clientTable = new RequestExecuter(Personnes::class);
        $Client = $clientTable->Execute($clientRequest);
    }
    $_POST['Role'] = $Client[0]->Role;
    $_POST['MotDePasse'] = $Client[0]->MotDePasse;

/**var_dump($_POST);
/**var_dump($Client);
echo $Client[0]->Nom;**/
?>
<p style="/*max-width: 30rem;*/text-align: center; margin: 100px 0 50px 0; font-size: xx-large ">
    Modifier un client
</p>
<form method="post" action="<?= Application::Instance()->Link("Client", "Update"); ?>" style="max-width: 30rem; margin: auto;">
    <div class="form-group">
        <input name="ID" class="form-control form-control-lg" type="hidden" value="<?php echo $Client[0]->ID; ?>" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Nom :</label>
        <input name="Nom" class="form-control form-control-lg" type="text" value="<?php echo $Client[0]->Nom; ?>" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Prénom :</label>
        <input name="Prenom" class="form-control form-control-lg" type="text" value="<?php echo $Client[0]->Prenom; ?>" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Adresse mail :</label>
        <input name="AdresseMail" class="form-control form-control-lg" type="text" value="<?php echo $Client[0]->AdresseMail; ?>" id="inputLarge">
    </div>
    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Modifier mot de passe :</label>
        <input name="MotDePasse" class="form-control form-control-lg" type="password" value="<?php echo $Client[0]->MotDePasse; ?>" id="inputLarge">
    </div>
    <div class="form-group">
        <input name="Role" class="form-control form-control-lg" type="hidden" value="<?php echo $Client[0]->Role; ?>" id="inputLarge">
    </div>
    <button type="submit" class="btn btn-primary" name="register" style="margin: 20px auto;">Modifier</button>
</form>

<?php

use Controllers\Application;

?>



<form method="post" action="<?= Application::Instance()->Link("SignIn", "Connexion"); ?>" style="max-width: 30rem; margin: 100px auto; ">
    <div class="form-group">
        <label for="exampleInputEmail1">Adresse mail</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="AdresseMail" aria-describedby="emailHelp" placeholder="Adresse mail">
        <small id="emailHelp" class="form-text text-muted">Votre addresse mail est gardée en secret dans les bases de données de Facebook.</small>
    </div>
    
    <div class="form-group">
        <label for="exampleInputPassword1">Mot de passe</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="MotDePasse" placeholder="Mot de passe">
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="log">
        <label class="form-check-label" for="exampleCheck1">Rester connecté</label>
    </div>

    <p>
        <button type="submit" class="btn btn-primary" name="log" style="margin: 10px auto;">Se connecter</button>

        <a href="<?= Application::Instance()->Link("Register", "Register"); ?>" style="margin-left: 250px">
            <button type="button" class="btn btn-primary">S'inscrire</button>
        </a>
    </p>
</form>
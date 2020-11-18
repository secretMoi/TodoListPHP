<?php

namespace Controllers\Pages\Login;

use Controllers\Application;
use Controllers\Authentification\Security;
use Controllers\Database\RequestBuilder;
use Controllers\Database\RequestExecuter;
use Controllers\FormValidator;
use Controllers\Pages\BaseController;
use Controllers\Parts\Alert;
use Models\Personnes;

class SignIn extends BaseController
{
    public function Log()
    {
        $this->RenderSimple("Login\log");
    }

    public function Deco()
    {
        // Détruit toutes les variables de session
	    $_SESSION = array();

        // Si vous voulez détruire complètement la session, effacez également
        // le cookie de session.
        // Note : cela détruira la session et pas seulement les données de session !
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalement, on détruit la session.
        session_destroy();

	    Application::SetAlert(new Alert(Alert::$Success, "Vous avez bien été déconnecté"));
	    header('Location: ' .  Application::Instance()->Link('SignIn', 'Log'));
    }

    public function Connexion(){
        // vérification des champs
        if(!FormValidator::IsSet($_POST, array("AdresseMail", "MotDePasse")))
            return;

        // convertit les var post en model
        $personne = new Personnes();
        $personne->Array2Model($_POST);

        // hash le mdp
        $security = new Security();
        $personne->MotDePasse = $security->Hash($personne->MotDePasse);

        // récupère la personnes correspondante
        $personneRequest = new RequestBuilder();
        $personneRequest->Select("*")
            ->From(Personnes::class)
            ->Where("AdresseMail", $personne->AdresseMail);
        $personneTable = new RequestExecuter(Personnes::class);
        $personneResult = $personneTable->Execute($personneRequest)[0];

        if ($personneResult->MotDePasse == $personne->MotDePasse)
        {
            /* on est bien connecté */

            $_SESSION['Id'] = $personneResult->ID;
            $_SESSION['Nom'] = $personneResult->Nom;
            $_SESSION['Prenom'] = $personneResult->Prenom;
            $_SESSION['AdresseMail'] = $personneResult->AdresseMail;
            $_SESSION['Role'] = $personneResult->Role;

	        Application::SetAlert(new Alert(Alert::$Success, "Connecté en tant que " . $personneResult->Nom));

            $link = 'index.php';
            header("Location: $link");
        }
    }
}

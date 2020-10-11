<?php

use Controllers\Application;

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="#"><?= Application::Instance()->title; ?></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarColor01">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="<?= Application::Instance()->Link(null, null); ?>">Accueil <span class="sr-only">(current)</span></a>
			</li>
			<!--<li class="nav-item">
				<a class="nav-link" href="<?= Application::Instance()->Link("SignIn", "Log"); ?>">Se connecter</a>
			</li>-->
			<li class="nav-item">
				<a class="nav-link" href="#">Pricing</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">About</a>
			</li>
		</ul>
        <div class="form-inline my-2 my-lg-0">
            <!--<li class="nav-item">-->
                <a class="nav-item nav-link" href="<?= Application::Instance()->Link("SignIn", "Log"); ?>">Se connecter</a>
            <!--</li>
            <li class="nav-item">-->
                <a class="nav-item nav-link" href="<?= Application::Instance()->Link("Register", "Register"); ?>">S'inscrire</a>
            <!--</li>-->
        </div>
	</div>
</nav>

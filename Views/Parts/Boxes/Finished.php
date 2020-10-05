<?php
/**
 * @var string $header Header de la box
 * @var string $title Titre du texte de la box
 * @var string $content Contenu à afficher
 */
?>

<div class="card border-primary mb-3" style="max-width: 20rem;">
	<div class="card-header"><?= $header; ?></div>
	<div class="card-body">
		<h4 class="card-title"><?= $title; ?></h4>
		<p class="card-text"><?= $content; ?></p>
	</div>
</div>
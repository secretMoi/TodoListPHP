<?php


class BaseController
{
	protected $viewPath;
	protected $template;

	/**
	 * @param string $view Nom de la vue à afficher
	 * @param array $variables Liste des variables à passer en paramètre à la vue
	 */
	protected function Render(string $view, $variables = []) { // gère le rendu
		ob_start();

		extract($variables); // donne accès aux variables $posts et $categories
		require($this->viewPath . 'Pages/' . str_replace('.', '/', $view) . '.php'); // accède à la vue correspondante au controleur
		$content = ob_get_clean();

		require($this->viewPath . $this->template . '.php'); // demande le template pour afficher le contenu généré
	}
}
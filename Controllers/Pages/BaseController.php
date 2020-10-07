<?php

namespace Controllers\Pages;

class BaseController
{
	protected $viewPath = ROOT . 'Views/Pages/';
	protected $partPath = ROOT . 'Views/Parts/';
	protected $template = 'layout';
	protected $templateSimple = 'layoutSimple';

	/**
	 * @param string $view Nom de la vue à afficher
	 * @param array $variables Liste des variables à passer en paramètre à la vue
	 */
	protected function Render(string $view, $variables = []) { // gère le rendu
		ob_start();

		extract($variables); // donne accès aux variables $posts et $categories
		require($this->viewPath . str_replace('.', '/', $view) . '.php'); // accède à la vue correspondante au controleur
		$content = ob_get_clean();

		require($this->viewPath . $this->template . '.php'); // demande le template pour afficher le contenu généré
	}

    protected function RenderSimple(string $view, $variables = []) { // gère le rendu
        ob_start();

        extract($variables); // donne accès aux variables $posts et $categories
        require($this->viewPath . str_replace('.', '/', $view) . '.php'); // accède à la vue correspondante au controleur
        $content = ob_get_clean();

        require($this->viewPath . $this->templateSimple . '.php'); // demande le template pour afficher le contenu généré
    }

    /**
	 * @param string $part Nom de la partie à afficher
	 * @param array $variables Liste des variables à passer en paramètre à la partie
	 */
	protected function AddPart(string $part, $variables = []) { // gère le rendu
		extract($variables); // donne accès aux variables $posts et $categories

		require($this->partPath . str_replace('.', '/', $part) . '.php'); // accède à la vue correspondante au controleur
	}
}
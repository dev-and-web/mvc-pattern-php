<?php

namespace Core\Controller;

use Core\Http\Response;

/**
 * Controller parent
 */
abstract class BaseController
{
    /**
     * Pour éventuellement utiliser un autre layout que celui par defaut
     *
     * @var string
     */
    private $layout;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->layout = 'site';
    }

    /**
     * Eventuellement utiliser un autre layout que celui par defaut
     *
     * @param string $layout
     */
    final protected function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    /**
     * Return vue
     *
     * @param string $view - Fichier View à charger
     * @param array $data - Pour passer d'éventuels données à la vue
     */
    final protected function view(string $view, array $data = [])
    {       
        if ($data) extract($data);

        ob_start();
        require base_path().'/app/views/'.$view.'.php';
        $contentInLayout = ob_get_clean();

        require base_path().'/app/views/layouts/'.$this->layout.'.php';

        exit();
    }

    /**
     * Spécifier l'en-tête HTTP de l'affichage d'une vue
     *
     * @param string $content
     * @param string|null $type
     */
    final protected function header(string $content, string $type = null)
    {
        Response::header($content, $type);
    }
}

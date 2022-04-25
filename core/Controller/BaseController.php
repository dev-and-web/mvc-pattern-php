<?php

namespace Core\Controller;

use Core\Http\Response;

/**
 * Parent Controller.
 */
abstract class BaseController
{
    /**
     * To possibly use a layout other than the default one.
     *
     * @var string
     */
    private string $layout;

    /**
     *  BaseController constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct()
    {
        $this->layout = 'site';
    }

    /**
     * To possibly use a layout other than the default one.
     *
     * @param string $layout
     */
    final protected function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    /**
     * Return view.
     *
     * @param string $view - View file to load.
     * @param array $data - To pass any data to the view.
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
     * Specify the HTTP header for displaying a view.
     *
     * @param string $content
     * @param string|null $type
     */
    final protected function header(string $content, string $type = null)
    {
        Response::header($content, $type);
    }
}

<?php

namespace Core\Routing;

use Core\Contracts\Routing\RouterInterface;
use Core\Http\Input;
use Core\Http\Request;
use Core\Http\Response;
use Core\Exception\ExceptionHandler;

/**
 * Gestion du Routing
 */
class Router implements RouterInterface
{
    /**
     * @var Router
     */
    private static $instance;

    /**
     * URI
     *
     * @var string
     */
    private $uri = '';

    /**
     * Routes
     *
     * @var array
     */
    private $routes = [];

    /**
     *  Routerconstructor.
     */
    private function __construct()
    {
        $this->setUri();
    }

    /**
     * Singleton
     *
     * @return mixed
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Setter de l'URI
     */
    private function setUri()
    {
        if (Input::hasGet('uri')) {
            $this->uri = ltrim(Input::get('uri'), '/');

            if (strpos(Request::getRequestUri(), '?uri=') !== false) {      
                Response::redirect($this->uri, 301);
            }
        }
    }

    /**
     * Ajouter une route
     *
     * @param string $path
     * @param string $action
     */
    public function add(string $path, string $action)
    {
        $this->routes[$path] = $action;
    }

    /**
     * Executer le Routing
     *
     * @return mixed
     */
    public function run()
    {
        foreach ($this->routes as $path => $action) {
            if ($this->uri == $path) {
                return $this->executeAction($action);
            }
        }

        return $this->executeError404();
    }

    /**
     * Executer l'action
     *
     * @param string $action
     * @throws ExceptionHandler
     * @return mixed
     */
    private function executeAction(string $action)
    {
        list($controller, $method) = explode('@', $action);

        $class = '\App\Controllers\\'.ucfirst($controller).'Controller';

        if (!class_exists($class)) {
            throw new ExceptionHandler('Class "'.$class.'" not found.');
        }

        $controllerInstantiate = new $class();

        if (!method_exists($controllerInstantiate, $method)) {
            throw new ExceptionHandler('Method "'.$method.'" not found in '.$class.'.');
        }

        return call_user_func_array([new $controllerInstantiate, $method], []);
    }

    /**
     * Retourner une erreur 404
     *
     * @return mixed
     */
    private function executeError404()
    {
        $error = new \App\Controllers\ErrorController();

        return $error->show404();
    }
}

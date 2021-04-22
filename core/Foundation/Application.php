<?php

namespace Core\Foundation;

use Core\Contracts\Routing\RouterInterface;

/**
 * Pour créer l'application
 */
class Application
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     *  Applicationconstructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * Cahrger la liste des routes et exécuter le Routing
     */
    public function run()
    {
        $this->router->run();
    }
}

<?php

use Core\Routing\Router;
use Core\Foundation\Application;

/**
 * Créer l'application
 */

/**
 * Instancier Router
 */
$router = Router::getInstance();

/**
 * Instancier Application
 */
$app = new Application($router);

/**
 * Retourner Application
 */
return $app;

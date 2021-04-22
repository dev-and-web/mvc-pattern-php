<?php

use Core\Routing\Router;

/**
 * Liste des routes
 */

$router = Router::getInstance();

$router->add('', 'Home@show');
$router->add('articles', 'Article@index');

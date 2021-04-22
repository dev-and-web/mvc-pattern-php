<?php

namespace App\Controllers;

/**
 * Gestion des erreurs
 */
class ErrorController extends Controller
{
    /**
     * Erreur HTTP 404
     */
    public function show404()
    {
        $this->header('HTTP/1.0 404 Not Found');

        return $this->view('error/404', [
            'baliseTitle' => 'Error 404 title',
            'metaDescription' => 'Error 404 desciption',
        ]);  
    }
}

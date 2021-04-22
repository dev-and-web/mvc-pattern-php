<?php

namespace App\Controllers;

/**
 * Gestion des articles
 */
class ArticleController extends Controller
{
    /**
     * Listing des articles
     */
    public function index()
    {
        return $this->view('article/index', [
            'baliseTitle' => 'Article listing title',
            'metaDescription' => 'Article listing desciption',
        ]);  
    }
}

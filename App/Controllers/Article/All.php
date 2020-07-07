<?php

namespace App\Controllers\Article;

use \App\Controllers\Controller;
use \App\Models\Article;

class All extends Controller
{
    protected function action()
    {
        $articles = Article::findAll();
        $this->view->twigDisplay('articles.html', ['articles' => $articles]);
    }
}
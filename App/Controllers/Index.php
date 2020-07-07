<?php

namespace App\Controllers;

use App\Models\Article;

class Index extends Controller
{
    protected function action()
    {
        $articles = Article::findLastCount(3);
        $this->view->twigDisplay('articles.html', ['articles' => $articles]);
    }
}
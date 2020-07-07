<?php

namespace App\Controllers\Article;

use \App\Controllers\Controller;
use \App\Models\Article;

class LastCount extends Controller
{
    protected function action()
    {
        //доделать чтоб можно было передавать число в качестве аргумента!
        $count = 3;
        $articles = Article::findLastCount($count);
        $this->view->twigDisplay('articles.html', ['articles' => $articles]);
    }
}
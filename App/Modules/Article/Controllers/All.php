<?php

namespace App\Modules\Article\Controllers;

use \App\Controllers\BaseController;
use \App\Models\Article;

class All extends BaseController
{
    protected function action()
    {
        $articles = Article::findAll();
        $this->view->twigDisplay('/App/Modules/Article/templates/index/articles.html', ['articles' => $articles]);
    }
}
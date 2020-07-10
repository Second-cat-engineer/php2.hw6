<?php

namespace App\Modules\Index\Controllers;;

use \App\Controllers\BaseController;
use App\Models\Article;

class Index extends BaseController
{
    protected function action()
    {
        $articles = Article::findLastCount(3);
        $this->view->twigDisplay('/App/Modules/Article/templates/index/articles.html', ['articles' => $articles]);
    }
}
<?php

namespace App\Controllers\Article;

use \App\Controllers\Controller;
use App\Exceptions\Error404;
use \App\Models\Article;

class One extends Controller
{
    protected function action()
    {
        $id = $_GET['id'];
        if (empty($id) || !is_numeric($id)) {
            throw new Error404('Некорректно введены данные, страница не найдена!', 404);
        }

        $article = Article::findById($id);

        if (false === $article) {
            throw new Error404('Страница не найдена!', 404);
        }
        $this->view->twigDisplay('article.html', ['article' => $article]);
    }
}
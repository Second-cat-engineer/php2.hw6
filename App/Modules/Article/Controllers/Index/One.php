<?php

namespace App\Modules\Article\Controllers\Index;

use \App\Controllers\BaseController;
use App\Exceptions\Error404;
use \App\Models\Article;
use App\Models\Comment;

class One extends BaseController
{
    protected function action()
    {
        $id = $_GET['id'];
        if (empty($id) || !is_numeric($id)) {
            throw new Error404('Некорректно введены данные, страница не найдена!', 404);
        }

        $article = Article::findById($id);

        if (empty($article)) {
            throw new Error404('Страница не найдена!', 404);
        }

        $comments = Comment::findByArticle($id);

        $this->view->twigDisplay('/App/Modules/Article/templates/index/article.html', [
            'article' => $article,
            'comments' => $comments,
            'user' => $this->view->user,
        ]);
    }
}
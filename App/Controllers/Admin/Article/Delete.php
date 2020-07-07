<?php

namespace App\Controllers\Admin\Article;

use App\Controllers\Admin;
use App\Exceptions\Error404;
use \App\Models\Article;

class Delete extends Admin
{
    protected function action()
    {
        $article = Article::findById($_POST['id']);
        if (false === $article) {
            throw new Error404('Ошибка при удалении! Статья с таким id не существует', 404);
        }
        $article->delete();

        header('Location: /admin/article/all');
    }
}
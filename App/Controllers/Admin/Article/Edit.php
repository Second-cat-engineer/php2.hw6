<?php

namespace App\Controllers\Admin\Article;

use App\Controllers\Admin;
use App\Exceptions\Error404;
use \App\Models\Article;

class Edit extends Admin
{
    protected function action()
    {
        $article = Article::findById($_POST['id']);
        if (false === $article) {
            throw new Error404('Ошибка при редактировании! Статья с таким id не существует', 404);
        }
        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../../../templates/admin/editArticle.php');
    }
}
<?php

namespace App\Modules\Article\Controllers\Admin;

use App\Controllers\AdminController;
use App\Exceptions\Error404;
use \App\Models\Article;

class Edit extends AdminController
{
    protected function action()
    {
        $article = Article::findById($_POST['id']);
        if (false === $article) {
            throw new Error404('Ошибка при редактировании! Статья с таким id не существует', 404);
        }
        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../../templates/admin/edit.php');
    }
}
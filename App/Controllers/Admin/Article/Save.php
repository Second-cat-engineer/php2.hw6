<?php

namespace App\Controllers\Admin\Article;

use App\Controllers\Admin;
use App\Exceptions\Error404;
use App\Exceptions\MultiException;
use \App\Models\Article;

class Save extends Admin
{
    protected function action()
    {
        if (empty($_POST['id'])) {
            $article = new Article();
        } else {
            $article = Article::findById($_POST['id']);
            if (false === $article) {
                throw new Error404('Ошибка при сохранении! Статья с таким id не существует', 404);
            }
        }

        try {
            $article->fill($_POST);
        } catch (MultiException $e) {
            $errors = $e->all();
            foreach ($errors as $error) {
                echo $error->getMessage();
            }
            exit();
        }

        $article->save();
        header('Location: /admin/article/all');
    }
}
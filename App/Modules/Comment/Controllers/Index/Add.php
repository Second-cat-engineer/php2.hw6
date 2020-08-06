<?php

namespace App\Modules\Comment\Controllers\Index;

use App\Controllers\BaseController;
use App\Exceptions\MultiException;
use App\Models\Comment;
use App\Models\User;

class Add extends BaseController
{
    protected function action()
    {
        if (!$this->view->user) {
            header('Location: /article/one/?id=' . $_POST['article_id']);
            exit();
        }

        $errors = new MultiException();

        if (empty($_POST['comment'])) {
            $errors->add(new \Exception('comment empty'));
        }
        if (empty($_POST['article_id'])) {
            $errors->add(new \Exception('article_id empty'));
        }

        if (!$errors->isEmpty()) {
            throw $errors;
        }

        $comment = new Comment();
        $comment->comment = $_POST['comment'];
        $comment->article_id = $_POST['article_id'];
        $comment->author_id = $this->view->user->getId();
        //var_dump($comment);

        $comment->save();
        header('Location: /article/one/?id=' . $_POST['article_id']);
    }
}
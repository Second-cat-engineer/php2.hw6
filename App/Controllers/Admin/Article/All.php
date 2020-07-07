<?php

namespace App\Controllers\Admin\Article;

use App\Controllers\Admin;
use \App\Models\Article;

class All extends Admin
{
    protected function action()
    {
        $this->view->articles = Article::findAll();
        $this->view->display(__DIR__ . '/../../../templates/admin/adminPanel.php');
    }
}
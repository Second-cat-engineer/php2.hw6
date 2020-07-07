<?php

namespace App\Controllers\Admin\Article;

use App\Controllers\Admin;

class Add extends Admin
{
    protected function action()
    {
        return $this->view->display(__DIR__ . '/../../../templates/admin/addArticle.php');
    }
}
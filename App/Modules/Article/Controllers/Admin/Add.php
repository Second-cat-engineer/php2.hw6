<?php

namespace App\Modules\Article\Controllers\Admin;

use App\Controllers\AdminController;

class Add extends AdminController
{
    protected function action()
    {
        return $this->view->display(__DIR__ . '/../../templates/admin/addArticle.php');
    }
}
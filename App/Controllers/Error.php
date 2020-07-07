<?php

namespace App\Controllers;

class Error extends Controller
{
    public function __construct(\Exception $error)
    {
        parent::__construct();
        $this->view->error = $error;
    }

    protected function action()
    {
        $this->view->twigDisplay('error.html', ['error' => $this->view->error]);
    }
}
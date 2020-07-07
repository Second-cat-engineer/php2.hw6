<?php

namespace App\Controllers;

use \App\Components\View;

abstract class Controller
{
    protected object $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function access():bool
    {
        return true;
    }

    public function __invoke()
    {
        if (!$this->access()) {
            die('Доступ закрыт');
        }
        $this->action();
    }

    abstract protected function action();
}
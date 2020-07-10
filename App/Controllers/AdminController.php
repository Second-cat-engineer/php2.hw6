<?php

namespace App\Controllers;

use \App\Components\View;

abstract class AdminController
{
    protected object $view;

    // пока что по умолчанию доступ будет админом,
    // после добавления аутентификации будет объект User
    protected $access = 'admin';

    public function __construct()
    {
        $this->view = new View();
    }

    protected function access():bool
    {
        if ('admin' === $this->access) {
            return true;
        }
        return false;
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
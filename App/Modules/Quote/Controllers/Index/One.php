<?php

namespace App\Modules\Quote\Controllers\Index;

use App\Controllers\BaseController;
use App\Exceptions\Error404;
use App\Models\Quote;

class One extends BaseController
{
    protected function action()
    {
        $id = $_GET['id'];
        if (empty($id) || !is_numeric($id)) {
            throw new Error404('Некорректно введены данные, страница не найдена!', 404);
        }

        $quote = Quote::findById($id);

        if (false === $quote) {
            throw new Error404('Страница не найдена!', 404);
        }

        $this->view->twigDisplay('/App/Modules/Quote/templates/index/quote.html', [
            'quote' => $quote,
            'user' => $this->view->user,
        ]);
    }
}
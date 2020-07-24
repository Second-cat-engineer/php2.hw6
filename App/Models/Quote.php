<?php

namespace App\Models;

use App\Exceptions\Validation;

class Quote extends Model
{
    protected const TABLE = 'quotes';


    public function validatorQuote($quote)
    {
        if (empty($quote)) {
            throw new Validation('Заголовок не должен быть пустым!');
        }
        return true;
    }

    public function validatorContent($content)
    {
        if (empty($content)) {
            throw new Validation('Текст не должен быть пустым!');
        }
        return true;
    }
}
<?php

namespace App\Models;

use App\Exceptions\Validation;

class Image extends Model
{
    public $path;
    protected const TABLE = 'images';

    public function validatorTitle($title)
    {
        if (empty($title)) {
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
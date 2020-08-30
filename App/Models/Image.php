<?php

namespace App\Models;

use App\Exceptions\Validation;

class Image extends Model
{
    public $path;
    public const TABLE = 'images';

    protected function validator($prop, $value)
    {
        switch ($prop) {
            case 'title':
                if (empty($value)) {
                    throw new Validation('Заголовок не должен быть пустым!');
                }
                return $this->$prop = $value;
                break;
            case 'content':
                if (empty($value)) {
                    throw new Validation('Текст не должен быть пустым!');
                }
                return $this->$prop = $value;
                break;
            default:
                return $this->$prop = $value;
        }
    }
}
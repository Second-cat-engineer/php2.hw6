<?php

namespace App\Models;

use App\Exceptions\Validation;

class Quote extends Model
{
    public const TABLE = 'quotes';

    public function __get($name)
    {
        switch ($name) {
            case 'author':
                return User::findById($this->author_id);
                break;
            default:
                return null;
        }
    }

    public function __isset($name)
    {
        switch ($name) {
            case 'author':
                return !empty($this->author_id);
                break;
            default:
                return null;
        }
    }

    protected function validator($prop, $value)
    {
        switch ($prop) {
            case 'quote':
                if (empty($value)) {
                    throw new Validation('Цитата не должна быть пустым!');
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
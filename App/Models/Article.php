<?php

namespace App\Models;

use App\Exceptions\Validation;
use App\Components\Model;

/**
 * Class One
 * @property $title
 * @property $content
 * @property int $author_id
 * @property object $author
 */
class Article extends Model
{
    protected const TABLE = 'articles';

    public function __get($name)
    {
        if ('author' === $name && !empty($this->author_id)) {
            return $this->author = Author::findById($this->author_id);
        }
        return null;

        /*
         * на случай, если не только автор будет запрашиваться
        switch ($name) {
            case 'author':
                return Author::findById($this->author_id);
                break;
            default:
                return null;
        }
        */
    }

    public function __isset($name)
    {
        if ('author' === $name) {
            return !empty($this->author_id);
        }
        return null;

        /*
        switch ($name) {
            case 'author':
                return !empty($this->author_id);
                break;
            default:
                return null;
        }
        */
    }


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
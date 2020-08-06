<?php

namespace App\Models;

use App\Components\Db;
use App\Exceptions\Validation;

/**
 * Class One
 * @property $title
 * @property $content
 * @property int $author_id
 * @property int $heading_id
 * @property object $author
 */
class Article extends Model
{
    protected const TABLE = 'articles';

    protected function validatorTitle($title)
    {
        if (empty($title)) {
            throw new Validation('Заголовок не должен быть пустым!');
        }
        return true;
    }

    protected function validatorContent($content)
    {
        if (empty($content)) {
            throw new Validation('Текст не должен быть пустым!');
        }
        return true;
    }

    protected function validatorHeading_id($heading_id)
    {
        return true;
    }

    public static function findByHeadingId($heading_id)
    {
        $param[':heading_id'] = $heading_id;
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE heading_id=:heading_id';
        $res = $db->query($sql, static::class, $param);
        if (empty($res)) {
            return false;
        }
        return $res;
    }

    public static function findByTitle($title)
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE title LIKE \'%' . $title . '%\'';
        $res = $db->query($sql, static::class, []);
        if (empty($res)) {
            return false;
        }
        return $res;
    }
}
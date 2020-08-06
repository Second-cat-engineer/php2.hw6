<?php

namespace App\Models;

use App\Components\Db;

/**
 * Class Comment
 * @property $comment
 * @property $author
 * @property $article_id
 * @property $date
 */
class Comment extends Model
{
    const TABLE = 'article_comments';

    public static function findByArticle($articleId)
    {
        $parameters[':article_id'] = $articleId;
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE article_id=:article_id';
        $res = $db->query($sql, static::class, $parameters);
        if (empty($res)) {
            return false;
        }
        return $res;
    }

    protected function validatorComment($comment)
    {
        if (empty($comment)) {
            throw new Validation('Комментарий не должен быть пустым!');
        }
        return true;
    }

    protected function validatorArticle_id($article_id)
    {
        if (empty($article_id)) {
            throw new Validation('айди статьи не должен быть пустым!');
        }
        return true;
    }
}
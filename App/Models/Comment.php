<?php

namespace App\Models;

use App\Components\Db;
use App\Exceptions\Validation;

/**
 * Class Comment+
 * @property $comment
 * @property $record_id
 * @property $module
 * @property $date
 * @property object $author
 */
class Comment extends Model
{
    const TABLE = 'comments';

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

    public static function findByRecord($moduleName, $recordId)
    {
        $parameters[':module'] = $moduleName;
        $parameters[':record_id'] = $recordId;
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE .
            ' WHERE record_id=:record_id AND module_id=(SELECT id FROM modules WHERE module=:module)';
        $res = $db->query($sql, static::class, $parameters);
        if (empty($res)) {
            return false;
        }
        return $res;
    }

    public function saveComment()
    {
        $props = [];
        $props['comment'] = $this->comment;
        $props['author_id'] = $this->author_id;
        $props['record_id'] = $this->record_id;
        $props['module'] = $this->module;
        //var_dump($props);

        $sql = 'INSERT INTO ' . static::TABLE .
            ' (comment, record_id, author_id, module_id) 
            VALUES (\'' . $props['comment'] . '\' , \'' . $props['record_id'] . '\' , 
            \'' . $props['author_id'] . '\' , 
            (SELECT id FROM modules WHERE module=\'' . $props['module'] . '\') )';
        //var_dump($sql);

        $db = Db::instance();
        $res = $db->execute($sql, []);
        $this->id = $db->lastId();
        return $res;
    }

    protected function validator($prop, $value)
    {
        switch ($prop) {
            case 'comment':
                if (empty($value)) {
                    throw new Validation('Комментарий не должен быть пустым!');
                }
                return $this->$prop = $value;
                break;
            default:
                return $this->$prop = $value;
        }
    }


}
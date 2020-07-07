<?php

namespace App\Models;

use App\Components\Db;
use App\Components\Model;

class User extends Model
{
    protected const TABLE = 'users';

    public string $email;
    public string $phone;

    public static function findByLogin($login)
    {
        $parameters[':login'] = $login;
        $db = Db::instance();
        $res = $db->query('SELECT * FROM ' . static::TABLE . ' WHERE login=:login', static::class, $parameters);
        if (empty($res)) {
            return false;
        }
        return $res[0];
    }
}
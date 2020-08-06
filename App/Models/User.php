<?php

namespace App\Models;

use App\Components\Db;
use App\Models\Model;

/**
 * @property $login
 * @property $passwordHash
 * @property $access
 */
class User extends Model
{
    protected const TABLE = 'users';
    public string $login;
    public string $access;
    protected string $passwordHash;

    public static function findByLogin($login)
    {
        $parameters[':login'] = $login;
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE login=:login';
        $res = $db->query($sql, static::class, $parameters);
        if (empty($res)) {
            return false;
        }
        return $res[0];
    }
}
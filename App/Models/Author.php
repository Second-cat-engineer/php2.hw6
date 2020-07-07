<?php

namespace App\Models;

use App\Components\Model;

/**
 * @property $login
 * @property $firstName
 * @property $lastName
 */
class Author extends Model
{
    protected const TABLE = 'authors';
}
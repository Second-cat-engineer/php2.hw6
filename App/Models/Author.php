<?php

namespace App\Models;

use App\Models\Model;

/**
 * @property $login
 * @property $firstName
 * @property $lastName
 */
class Author extends Model
{
    protected const TABLE = 'authors';
}
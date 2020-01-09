<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBlacklist extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'user_blacklist';
}

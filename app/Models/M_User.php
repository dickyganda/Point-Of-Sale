<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_User extends Model
{
    protected $table = 'm_user';
    public $timestamps = false;
    protected $primaryKey = 'id_user';
}

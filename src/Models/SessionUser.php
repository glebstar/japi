<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SessionUser extends Eloquent
{
    protected $table = 'SessionUser';

    public $timestamps = false;

    protected $fillable = ['SessionID', 'UserID'];
}

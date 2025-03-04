<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    protected $guard = 'member';

    protected $guarded = [];
    public function orders()
    {
        return $this->hasMany(Order::class,'member_id');
    }
}

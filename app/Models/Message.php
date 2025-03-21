<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function member(){
        return $this->belongsTo('App\Models\Member','sender_id');
    }
}

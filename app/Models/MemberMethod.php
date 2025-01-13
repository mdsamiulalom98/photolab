<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberMethod extends Model
{
    public function bankname(){
        return $this->belongsTo('App\Models\Bank','bank_id');
    }
}

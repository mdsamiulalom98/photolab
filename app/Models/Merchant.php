<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Merchant extends Authenticatable
{
    
    protected $guard = 'merchant';
    
    protected $guarded = [];
    
    public function district(){
        return $this->hasOne('App\Models\District','id','district_id');
    }
    public function area(){
        return $this->hasOne('App\Models\Thana','id','area_id');
    }
    public function parcels(){
        return $this->hasMany('App\Models\Parcel','merchant_id');
    }
}

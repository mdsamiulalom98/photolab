<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public function member()
    {
        return $this->belongsTo(Member::class,'member_id');
    }
    public function paymentdetails()
    {
        return $this->hasMany(PaymentDetails::class, 'order_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrialOrder extends Model
{
    public function trialimages()
    {
        return $this->hasMany(Trialimage::class, 'trial_id');
    }
}

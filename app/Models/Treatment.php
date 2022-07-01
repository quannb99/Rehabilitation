<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    public function records()
    {
        return $this->belongsToMany('App\Models\MedicalRecord', 'record_treatments', 'treatment_id', 'record_id');
    }
}

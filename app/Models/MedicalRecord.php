<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    public function treatments()
    {
        return $this->belongsToMany('App\Models\Treatment', 'record_treatments', 'record_id', 'treatment_id');
    }
}

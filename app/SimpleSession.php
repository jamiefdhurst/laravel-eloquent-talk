<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpleSession extends Model
{
    protected $dates = ['appointment'];

    public function patient()
    {
        return $this->belongsTo(SimplePatient::class, 'patient_id');
    }
}

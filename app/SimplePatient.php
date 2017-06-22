<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimplePatient extends Model
{
    protected $dates = ['date_of_birth'];

    public function sessions()
    {
        return $this->hasMany(SimpleSession::class, 'patient_id');
    }
}

<?php

namespace App\Solution3;

use Illuminate\Database\Eloquent\Model;

class PatientValue extends Model
{
    protected $guarded = [];

    public function field()
    {
        return $this->belongsTo(PatientField::class, 'patient_field_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


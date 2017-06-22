<?php

namespace App\Solution1;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $latestValues;

    public function __get($key)
    {
        if (array_key_exists($key, $this->latestValues())) {
            return $this->latestValues()[$key];
        }

        return parent::__get($key);
    }

    public function __isset($key)
    {
        if (array_key_exists($key, $this->latestValues())) {
            return true;
        }

        return parent::__isset($key);
    }

    public function latestValues()
    {
        if (is_null($this->latestValues)) {
            $this->latestValues = [];
            foreach ($this->values as $value) {
                if (!array_key_exists($value->slug, $this->latestValues)) {
                    $this->latestValues[$value->slug] = $value->value;
                }
            }
        }

        return $this->latestValues;
    }

    public function values()
    {
        return $this->hasMany(PatientValue::class, 'patient_id')
            ->orderBy('id', 'DESC');
    }
}


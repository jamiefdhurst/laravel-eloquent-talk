<?php

namespace App\Solution3;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $values = [];

    public function __get($key)
    {
        if (array_key_exists($key, $this->values)) {
            return $this->values[$key];
        }

        return parent::__get($key);
    }

    public function newCollection(array $models = [])
    {
        return new Collection($models);
    }

    public function setValues($values)
    {
        foreach ($values as $value) {
            $this->values[$value->slug] = $value->value;
        }
    }

    public function scopeWhereValue(Builder $query, $slug, $operator, $value = null)
    {
        if (is_null($value)) {
            $value = $operator;
            $operator = '=';
        }

        return $query->whereRaw(sprintf("(SELECT `value` FROM `patient_values` WHERE `patient_values`.`patient_id` = `patients`.`id` AND `patient_values`.`slug` = '%s' ORDER BY `id` DESC LIMIT 1) %s ?",
            $slug, $operator
        ), [$value]);
    }

}


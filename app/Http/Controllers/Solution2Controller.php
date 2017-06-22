<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class Solution2Controller extends Controller
{
    public function index()
    {
        // PDO query - get the patient fields first
        $patientValues = DB::select('
            SELECT v.*
            FROM patient_values v
            LEFT JOIN patient_values v2 ON (
              v.patient_id = v2.patient_id AND
              v.patient_field_id = v2.patient_field_id AND
              v.id < v2.id
            )
            WHERE v2.id IS NULL
            ORDER BY v.patient_id DESC, v.patient_field_id
        ', []);

        // Reorganise these into patients
        $patients = [];
        foreach ($patientValues as $value) {
            if (!array_key_exists($value->patient_id, $patients)) {
                $patients[$value->patient_id] = new \stdClass();
                $patients[$value->patient_id]->id = $value->patient_id;
                $patients[$value->patient_id]->updated_at = $value->updated_at;
            }
            $patients[$value->patient_id]->{$value->slug} = $value->value;
        }

        return view('solution.index', [
            'patients' => $patients
        ]);
    }

    public function pain()
    {
        // PDO query - get the patient fields first
        $patientValues = DB::select('
            SELECT v.*
            FROM patient_values v
            LEFT JOIN patient_values v2 ON (
              v.patient_id = v2.patient_id AND
              v.patient_field_id = v2.patient_field_id AND
              v.id < v2.id
            )
            WHERE v2.id IS NULL AND (
              SELECT value FROM patient_values
              WHERE patient_values.patient_id = v.patient_id
              AND patient_values.slug = "pain"
              ORDER BY id DESC LIMIT 1
            ) > 7
            ORDER BY v.patient_id DESC, v.patient_field_id
        ', []);

        // Reorganise these into patients
        $patients = [];
        foreach ($patientValues as $value) {
            if (!array_key_exists($value->patient_id, $patients)) {
                $patients[$value->patient_id] = new \stdClass();
                $patients[$value->patient_id]->id = $value->patient_id;
                $patients[$value->patient_id]->updated_at = $value->updated_at;
            }
            $patients[$value->patient_id]->{$value->slug} = $value->value;
        }

        return view('solution.index', [
            'patients' => $patients
        ]);
    }
}

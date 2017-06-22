<?php

namespace App\Http\Controllers;

use App\Solution3\Patient;

class Solution3Controller extends Controller
{
    public function index()
    {
        // Eloquent query to pull all patients
        $patients = Patient::query()
            ->orderBy('id', 'DESC')
            ->get();

        return view('solution.index', [
            'patients' => $patients
        ]);
    }

    public function pain()
    {
        // Eloquent query to pull all patients
        $patients = Patient::query()
            ->whereValue('pain', '>', 7)
            ->orderBy('id', 'DESC')
            ->get();

        return view('solution.index', [
            'patients' => $patients
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Solution1\Patient;

class Solution1Controller extends Controller
{
    public function index()
    {
        // Eloquent query to pull all patients
        $patients = Patient::query()
            ->with('values')
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
            ->with('values')
            ->orderBy('id', 'DESC')
            ->get()->where('pain', '>', 7);

        return view('solution.index', [
            'patients' => $patients
        ]);
    }
}

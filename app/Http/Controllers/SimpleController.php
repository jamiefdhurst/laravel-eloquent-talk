<?php

namespace App\Http\Controllers;

use App\SimplePatient;
use App\SimpleSession;

class SimpleController extends Controller
{
    public function index()
    {
        // Eloquent query to pull all patients
        $patients = SimplePatient::query()
            ->orderBy('id', 'DESC')
            ->get();

        return view('simple.index', [
            'patients' => $patients
        ]);
    }

    public function lazyLoading()
    {
        // Eloquent query to pull all sessions
        $sessions = SimpleSession::query()
            ->orderBy('appointment', 'DESC')
            ->get();

        return view('simple.sessions', [
            'sessions' => $sessions
        ]);
    }

    public function eagerLoading()
    {
        // Eloquent query to pull all sessions, with an eager load
        $sessions = SimpleSession::query()
            ->with('patient')
            ->orderBy('appointment', 'DESC')
            ->get();

        return view('simple.sessions', [
            'sessions' => $sessions
        ]);
    }
}

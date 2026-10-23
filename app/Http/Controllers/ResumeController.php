<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function create()
    {
        return view('resumes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf|max:5120',
        ]);

        dd('Validation passed!', $request->file('resume')->getClientOriginalName());
    }
}

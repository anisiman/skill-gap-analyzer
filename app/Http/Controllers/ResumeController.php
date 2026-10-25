<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;

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

        $path = $request->file('resume')->store('resumes');

        $parser = new Parser(); // create pDF-reading tool
        $fullPath = Storage::path($path);
        $pdf = $parser->parseFile($fullPath);
        $text = $pdf->getText();

        $user = $request->user();
        $filename = $request->file('resume')->getClientOriginalName();

        $resume = $user->resumes()->create([
            'original_filename'=> $filename,
            'file_path' => $path,
            'extracted_text' => $text,
        ]);

        return redirect()->route('resumes.create')->with('status', 'Resume uploaded successfully!');
    }
}

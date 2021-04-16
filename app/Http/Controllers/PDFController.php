<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function question(Question $question){        
    $pdf = PDF::loadView('pdf.question', compact('question'))->setPaper('a4');
        // dd($question);
        return $pdf->download('question.pdf');
    }
}

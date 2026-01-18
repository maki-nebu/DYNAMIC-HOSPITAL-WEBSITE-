<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    // Show FAQ page
    public function index()
    {
        $faqs = Faq::all(); // Get all FAQs
        return view('faqs.index', compact('faqs'));
    }

    // AJAX search for FAQs
    public function search(Request $request)
    {
        $term = $request->input('term', '');
        $faqs = Faq::where('question', 'LIKE', "%{$term}%")->get();
        return response()->json($faqs);
    }
}

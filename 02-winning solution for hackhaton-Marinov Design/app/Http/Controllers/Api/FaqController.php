<?php

namespace App\Http\Controllers\Api;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Mail\FaqNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();

        if ($faqs) {
            return response()->json([
                'success' => true,
                'message' => 'FAQs retrieved successfully',
                'data' => $faqs

            ], 200);
        }

        return response()->json(['success' => false, 'message' => 'No FAQs found']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
        ]);
        $faq = Faq::create($validatedData);
        if ($faq) {
            Mail::to('admin@example.com')->send(new FaqNotification($faq));

            return response()->json([
                'success' => true,
                'message' => 'FAQ created successfully',
                'data' => $faq
            ], 201);
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong']);
    }
}

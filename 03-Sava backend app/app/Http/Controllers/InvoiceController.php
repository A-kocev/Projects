<?php

// app/Http/Controllers/InvoiceController.php
namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function showInvoice()
    {
    // Fetch policies with the status 'pay now'
        $policies = Invoice::where('status', 'pay now')->get();

        return view('pdfs.invoice', compact('policies'));
    }
}

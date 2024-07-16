<?php


use App\Models\Damage;
use App\Models\Policy;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\GoogleController;

// invoices
Route::get('/invoices', function () {
    return response()->json([auth()->user()->invoices,auth()->user()->name]);
})->middleware('auth:api');

//Policies
Route::get('/policies', function () {
    return response()->json([auth()->user()->policies,auth()->user()->name]);
})->middleware('auth:api');
// damages
Route::get('/damages', function () {
    return response()->json(auth()->user()->damages);
})->middleware('auth:api');

// register and login
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});

// pdf downloades
Route::get('/invoicePdf/{invoiceNumber}', function ($invoiceNumber) {
    $decodedInvoiceNumber = base64_decode($invoiceNumber);
    $invoice = Invoice::where('invoice_number', $decodedInvoiceNumber)->first();
     if ($invoice && $invoice->status == 'pay now') {
        // Generate the PDF
        $pdf = Pdf::loadView('pdfs.invoice', ['invoice' => $invoice]);
        return $pdf->download('invoice.pdf');
    }

    return response()->json(['message' => 'Invoice is already paid or not found'], 404);
});

Route::get('/policyPdf/{policyNumber}', function($policyNumber){
    $decodedPolicyNumber = base64_decode($policyNumber);
    $policy = Policy::where('policy_number', $decodedPolicyNumber)->first();

    if ($policy && $policy->active == 1) {
        // Generate the PDF
        $pdf = Pdf::loadView('pdfs.policy', ['policy' => $policy]);
        return $pdf->download('policy.pdf');
    }

    return response()->json(['message' => 'Policy is not active or not found'], 404);
});

  // socialite
Route::get('/auth/google/redirect', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'discount_code' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'total_amount' => 'required|numeric',
            
        ]);

        $order = Order::create($validatedData);

      
        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully');
    }

   
}

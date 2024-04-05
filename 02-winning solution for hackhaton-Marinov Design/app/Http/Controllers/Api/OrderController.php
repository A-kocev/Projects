<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    

       
        public function placeOrder(Request $request)
        {
           
            // Validate the incoming request data
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email',
                'country' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'zip_code' => 'required|integer',
                'address' => 'required|string|max:255',
                'discount_code' => 'nullable|string|max:255|exists:discounts,discount_code',
                'total_amount' => 'required|numeric',
                'products' => 'required|array', 
            ]);
          
            // Create a new order
            $order = Order::create($validatedData);
    
            // Attach products to the order with quantities
            foreach ($validatedData['products'] as $product) {
                $order->products()->attach($product['product_id'], ['quantity' => $product['quantity']]);
            }
            
            Mail::to('admin@example.com')->send(new OrderNotification($order));

            // Return a response indicating the success of the order placement
            return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
        }

    
}

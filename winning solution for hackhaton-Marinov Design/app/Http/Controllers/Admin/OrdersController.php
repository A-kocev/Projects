<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index(){
       $orders= Order::all();

        return view('orders.all-orders',compact('orders'));
    }

    public function show(string $id){

        $orders= Order::with('products')->where('id',$id)->first();
       
         return view('orders.show-order',compact('orders'));
     }
}

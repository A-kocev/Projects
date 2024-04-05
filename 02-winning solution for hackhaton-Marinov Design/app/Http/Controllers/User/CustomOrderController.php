<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomOrder; 

class CustomOrderController extends Controller
{
    public function index(){
        $custom_orders = CustomOrder::all();
        return view('custom_orders.all-orders',compact('custom_orders'));
    }



    public function show(string $id)
    {
        $custom_order = CustomOrder::where('id',$id)->first();
        return view('custom_orders.show-custom_order',compact('custom_order'));
    }
    public function destroy(string $id)
    {   
        $custom_order = CustomOrder::where('id',$id)->first();
        $custom_order->delete();
        return redirect()->route('custom_order.index')->with('success', 'Custom Order deleted successfully.');
    }

}

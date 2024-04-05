<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
   public function index(){
    $products = Product::with('images', 'materials', 'maintenances')->get();
    return response()->json(['data' => $products,200]);
   }
   public function show(string $id){
    $product = Product::with('images', 'materials', 'maintenances')->findOrFail($id);
    return response()->json(['data' => $product,200]);
    
   }
   public function productsByType(string $typeId){
      $products = Product::with('images', 'materials', 'maintenances')->where('type_id',$typeId)->get();
      return response()->json(['data' => $products,200]);
   }
}
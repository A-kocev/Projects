<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Type;
use App\Models\Product;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return response()->json(['data' => $types,200]);
    }
    public function typesByCategory(string $categoryId)
    {
        $types = Type::where('category_id', $categoryId)->get();
        return response()->json(['data' => $types,200]);
    }
    public function typesByCategoryAndProductType(string $categoryId, string $productId)
    {
        $types = Type::where('category_id', $categoryId)->get();
        $product = Product::find($productId);
        return response()->json(['types' => $types, 'product' => $product,200]);
    }
    public function jewelryTypes()
    {
        $category = Category::where('name','jewelry')->get()->first();
        return response()->json(['data' => $category->types,200]);
    }
    public function homeDecoTypes()
    {
        $category = Category::where('name', 'LIKE', 'home' . '%')->get()->first();
        return response()->json(['data' => $category->types ,200]);
    }
}
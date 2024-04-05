<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function categoriesByBrand(string $brandId)
    {
        $brand = Brand::find($brandId);
        $categories = $brand->categories;
        return response()->json(['data' => $categories, 'status' => 200]);
    }
    public function categoriesByBrandAndProductCategory(string $brandId, string $productId)
    {
        $brand = Brand::find($brandId);
        $categories = $brand->categories;
        $productCategory = Product::find($productId)->category_id;
        return response()->json(['data' => ['categories' => $categories, 'productCategory' => $productCategory], 'status' => 200]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function deleteProductImage(Request $request)
    {
        $product = Product::find($request->productId);

        switch ($request->img) {
            case 'img_1':
                $imgToDelete = $product->images()->skip(1)->first();
                break;
            case 'img_2':
                $imgToDelete = $product->images()->skip(2)->first();
                break;
            case 'img_3':
                $imgToDelete = $product->images()->skip(3)->first();
                break;
            default:
                $imgToDelete = null;
                break;
        }

        if ($imgToDelete) {
            $imgToDelete->delete();
        }
        return response()->json(['message' => 'Image deleted successfully']);
    }
    public function deleteBrandImage(Request $request)
    {
        $brand = Brand::find($request->brandId);

        switch ($request->img) {
            case 'img_1':
                $imgToDelete = $brand->images()->skip(1)->first();
                break;
            case 'img_2':
                $imgToDelete = $brand->images()->skip(2)->first();
                break;
            case 'img_3':
                $imgToDelete = $brand->images()->skip(3)->first();
                break;
            default:
                $imgToDelete = null;
                break;
        }

        if ($imgToDelete) {
            $imgToDelete->delete();
        }
        return response()->json(['message' => 'Image deleted successfully']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::all();

        if ($gallery) {
            return response()->json([
                'success' => true,
                'message' => 'FAQs retrieved successfully',
                'data' => $gallery
            ], 200);
        }


        return response()->json(['success' => false, 'message' => 'No images found']);
    }

    public function latestSix() {
        $latestImages = Gallery::latest()->take(6)->get();
        if ($latestImages) {
            return response()->json([
                'success' => true,
                'message' => 'FAQs retrieved successfully',
                'data' => $latestImages
            ], 200);
        }


        return response()->json(['success' => false, 'message' => 'No images found']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('images.all-images', compact('images'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image_url' => 'required|url',
            'product_id' => 'required|exists:products,id',
        ]);

        $image = Image::create($validated);
        return response()->json($image, 201);
    }

    public function show($id)
    {
        $image = Image::findOrFail($id);
        return response()->json($image);
    }

    public function update(Request $request, $id)
    {
        $image = Image::findOrFail($id);

        $validated = $request->validate([
            'image_url' => 'sometimes|url',
            'product_id' => 'sometimes|exists:products,id',
        ]);

        $image->update($validated);
        return response()->json($image);
    }

    public function destroy($id)
    {
        Image::findOrFail($id)->delete();
        return response()->json('Image deleted successfully');
    }
}

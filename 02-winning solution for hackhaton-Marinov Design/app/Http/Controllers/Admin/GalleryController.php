<?php

namespace App\Http\Controllers\Admin;

use ImageKit\ImageKit;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        return view('gallery.full-gallery', compact('galleries'));
    }

    public function create()
    {
        return view('gallery.add-gallery');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageKit = new ImageKit(
            "public_yHkkydctuDLQxoy5zFiseD9ZiW0=",
            "private_yPLFIGZ49woAFKkKT8eyt2yriCE=",
            "https://ik.imagekit.io/hx2cyuc3r"
        );

        $imageUrls = [];

        foreach ($request->file('images') as $index => $image) {
            $fileType = mime_content_type($image->getPathname());
            $file = $imageKit->uploadFile([
                'file' => 'data:' . $fileType . ';base64,' . base64_encode(file_get_contents($image->getPathname())),
                'fileName' => 'picture_' . $index,
            ]);

            $imageUrls[] = $file->result->url;
        }

        Gallery::create([
            'images' => $file->result->url,
        ]);

        return redirect()->route('gallery.index')->with('successAdd', 'Gallery images added');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        return redirect()->route('gallery.index')->with('successDelete', "Gallery images Deleted");
    }
}

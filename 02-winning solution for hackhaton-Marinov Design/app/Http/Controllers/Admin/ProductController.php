<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Image;
use ImageKit\ImageKit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Material;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->get('search') || $request->get('category') || $type = $request->get('type')) {

            $search = $request->get('search');
            $category =  $request->get('category');
            $type = $request->get('type');

            $products = Product::query()
                ->with('category', 'type', 'materials', 'maintenances', 'images')
                ->where('title', 'like', "%$search%")
                ->where('category_id', 'like', "%$category%")
                ->where('type_id', 'like', "%$type%")->paginate(6);
        } else {
            $products = Product::with('category', 'type', 'materials', 'maintenances', 'images')
                ->paginate(6);
        }

        $categories = Category::all();
        $types = Type::all();



        return view('products.all-products', compact('products', 'categories', 'types'));
    }


    public function create()
    {
        
        $categories = Category::all();
        $materials = Material::all();
        $maintenances = Maintenance::all();
        return view('products.add-product', compact('categories', 'materials', 'maintenances'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'categories' => 'required',
            'types' => 'required',
            'materials' => 'required|array|min:1',
            'desc' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'is_featured' => 'boolean',
            'weight' => 'required',
            'dimensions' => 'required|string',
            'main_img' => 'required',
            'maintenances' => 'required|array|min:1',
            'discount' => 'sometimes|min:0|max:99'
        ]);

        $product = Product::create([
            'title' => $request->input('title'),
            'description' => $request->input('desc'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'is_featured' => $request->input('is_featured'),
            'weight' => $request->input('weight'),
            'dimensions' => $request->input('dimensions'),
            'category_id' => $request->input('categories'),
            'type_id' => $request->input('types'),
            'discount' => $request->input('discount')
        ]);


        $imageKit = new ImageKit(
            "public_yHkkydctuDLQxoy5zFiseD9ZiW0=",

            "private_yPLFIGZ49woAFKkKT8eyt2yriCE=",
            "https://ik.imagekit.io/hx2cyuc3r"
        );

        if ($_FILES['main_img']['tmp_name']) {
            $fileTypeMain = mime_content_type($_FILES['main_img']['tmp_name']);

            $file = $imageKit->uploadFile([
                'file' => 'data:' . $fileTypeMain . ';base64,' . base64_encode(file_get_contents($_FILES['main_img']['tmp_name'])),
                'fileName' => 'picture',
            ]);

            Image::create([
                'image_url' => $file->result->url,
                'product_id' => $product->id
            ]);
        }
        
        if ($_FILES['img_1']['tmp_name']) {
            $fileType1 = mime_content_type($_FILES['img_1']['tmp_name']);

            $file1 = $imageKit->uploadFile([
                'file' => 'data:' . $fileType1 . ';base64,' . base64_encode(file_get_contents($_FILES['img_1']['tmp_name'])),
                'fileName' => 'picture',
            ]);

            Image::create([
                'image_url' => $file1->result->url,
                'product_id' => $product->id
            ]);
        }
        if ($_FILES['img_2']['tmp_name']) {
            $fileType2 = mime_content_type($_FILES['img_2']['tmp_name']);

            $file2 = $imageKit->uploadFile([
                'file' => 'data:' . $fileType2 . ';base64,' . base64_encode(file_get_contents($_FILES['img_2']['tmp_name'])),
                'fileName' => 'picture',
            ]);
            Image::create([
                'image_url' => $file2->result->url,
                'product_id' => $product->id
            ]);
        }
        if ($_FILES['img_3']['tmp_name']) {
            $fileType3 = mime_content_type($_FILES['img_3']['tmp_name']);

            $file3 = $imageKit->uploadFile([
                'file' => 'data:' . $fileType3 . ';base64,' . base64_encode(file_get_contents($_FILES['img_3']['tmp_name'])),
                'fileName' => 'picture',
            ]);
            Image::create([
                'image_url' => $file3->result->url,
                'product_id' => $product->id
            ]);
        }

        $product->materials()->sync($request->input('materials', []));
        $product->maintenances()->sync($request->input('maintenances', []));
        return redirect()->route('products.index')->with('successAdd', 'Product added successfully.');
    }

    public function edit(string $id)
    {
        $categories = Category::all();
        $materials = Material::all();
        $maintenances = Maintenance::all();
        $product = Product::findOrFail($id);
        $mainImage = Image::where('product_id', $id)->first();
        $images = Image::where('product_id', $id)->get()->skip(1);
        return view('products.edit-product', compact('product', 'categories', 'materials', 'maintenances', 'mainImage', 'images'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'categories' => 'required',
            'types' => 'required',
            'materials' => 'required|array|min:1',
            'desc' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'is_featured' => 'boolean',
            'weight' => 'required',
            'dimensions' => 'required|string',
            'maintenances' => 'required|array|min:1',
            'discount' => 'sometimes|min:0|max:99'
        ]);

        $product = Product::find($request->id);
        $product->update([
            'title' => $request->input('title'),
            'description' => $request->input('desc'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'is_featured' => $request->input('is_featured'),
            'weight' => $request->input('weight'),
            'dimensions' => $request->input('dimensions'),
            'category_id' => $request->input('categories'),
            'type_id' => $request->input('types'),
            'discount' => $request->input('discount')
        ]);

        $newImage = new Image;

        $imageKit = new ImageKit(
            "public_yHkkydctuDLQxoy5zFiseD9ZiW0=",

            "private_yPLFIGZ49woAFKkKT8eyt2yriCE=",
            "https://ik.imagekit.io/hx2cyuc3r"
        );

        if ($_FILES['main_img']['tmp_name']) {
            $fileTypeMain = mime_content_type($_FILES['main_img']['tmp_name']);

            $file = $imageKit->uploadFile([
                'file' => 'data:' . $fileTypeMain . ';base64,' . base64_encode(file_get_contents($_FILES['main_img']['tmp_name'])),
                'fileName' => 'picture',
            ]);

            $mainImage = Image::where('product_id', $product->id)->first();

            $mainImage->update([
                'image_url' => $file->result->url,
                'product_id' => $request->id
            ]);
        }
        if ($_FILES['img_1']['tmp_name']) {
            $fileType1 = mime_content_type($_FILES['img_1']['tmp_name']);

            $file1 = $imageKit->uploadFile([
                'file' => 'data:' . $fileType1 . ';base64,' . base64_encode(file_get_contents($_FILES['img_1']['tmp_name'])),
                'fileName' => 'picture',
            ]);

            $image1 = Image::where('product_id', $product->id)->get()->skip(1)->first();

            if ($image1) {
                $image1->update([
                    'image_url' => $file1->result->url,
                    'product_id' => $request->id
                ]);
            } else {
                Image::create([
                    'image_url' => $file1->result->url,
                    'product_id' => $product->id
                ]);
            }
        }
        if ($_FILES['img_2']['tmp_name']) {
            $fileType2 = mime_content_type($_FILES['img_2']['tmp_name']);


            $file2 = $imageKit->uploadFile([
                'file' => 'data:' . $fileType2 . ';base64,' . base64_encode(file_get_contents($_FILES['img_2']['tmp_name'])),
                'fileName' => 'picture',
            ]);

            $image2 = Image::where('product_id', $product->id)->get()->skip(2)->first();

            if ($image2) {
                $image2->update([
                    'image_url' => $file2->result->url,
                    'product_id' => $request->id
                ]);
            } else {
                Image::create([
                    'image_url' => $file2->result->url,
                    'product_id' => $product->id
                ]);
            }
        }
        if ($_FILES['img_3']['tmp_name']) {
            $fileType3 = mime_content_type($_FILES['img_3']['tmp_name']);


            $file3 = $imageKit->uploadFile([
                'file' => 'data:' . $fileType3 . ';base64,' . base64_encode(file_get_contents($_FILES['img_3']['tmp_name'])),
                'fileName' => 'picture',
            ]);

            $image3 = Image::where('product_id', $product->id)->get()->skip(3)->first();

          
            if ($image3) {
                $image3->update([
                    'image_url' => $file3->result->url,
                    'product_id' => $request->id
                ]);
            } else {
                Image::create([
                    'image_url' => $file3->result->url,
                    'product_id' => $product->id
                ]);
            }
        }

        $product->materials()->sync($request->input('materials', []));
        $product->maintenances()->sync($request->input('maintenances', []));
        
        return redirect()->route('products.index')->with('successEdit', 'Product updated successfully.');
    }
    public function destroy(string $id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('successDelete', 'Product deleted successfully.');
    }
}

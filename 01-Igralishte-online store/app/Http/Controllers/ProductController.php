<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Tag;
use Illuminate\Http\Request;
use ImageKit\ImageKit;

class ProductController extends Controller
{

    public $imageKit;
    public function __construct()
    {
        $this->imageKit = new ImageKit(
            "public_UbUNfInfezMko1r2ZGjnJ4dpTbM=",
            "private_GBZPx7wsb1+IftWG8G4yhO4an7Q=",
            "https://ik.imagekit.io/y621ggiyc"
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(8);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        $discounts = Discount::all();
        return view('products.add-product', compact('sizes', 'colors', 'brands', 'discounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $request->validate([
            'main_img' => 'required'
        ], [
            'main_img.required' => 'Првата слика е задолжителна.',
        ]);
        //creating product
        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'size_hint' => $request->input('size_hint'),
            'maintenance_guidelines' => $request->input('maintenance_guidelines'),
            'brand_id' => $request->input('brand'),
            'category_id' => $request->input('category'),
            'discount_id' => $request->input('discount'),
            'status' => $request->input('status') ?? 1
        ]);
        // writing down the sizes and syncing product_size table
        $newsizes = [];
        if ($request->input('newsizes')) {
            foreach ($request->input('newsizes') as $newsize) {
                if (!Size::where('name', $newsize)->exists() && !empty($newsize)) {
                    $createdSize = Size::create(['name' => strtoupper($newsize)]);
                    $newsizes[] = $createdSize->id;
                }
            }
        }
        $sizes = array_merge($request->input('sizes'), $newsizes);
        $product->sizes()->sync($sizes);

        // syncing color_product table
        $product->colors()->sync($request->input('colors', []));


        // Extract tag values from the array of objects and syncing product_tag table
        $tagsArray = json_decode($request->input('tags'), true);
        $tagValues = array_map(function ($tag) {
            return $tag['value'];
        }, $tagsArray);
        $tags = [];
        foreach ($tagValues as $tagValue) {
            if (!Tag::where('name', $tagValue)->exists() && !empty($tagValue)) {
                $createdTag = Tag::create(['name' => strtoupper($tagValue)]);
                $tags[] = $createdTag->id;
            } else {
                $tagId = Tag::where('name', $tagValue)->pluck('id')->first();
                $tags[] = $tagId;
            }
        }
        $product->tags()->sync($tags);
        // store the images
        $imageFields = ['main_img', 'img_1', 'img_2', 'img_3'];
        foreach ($imageFields as $field) {
            if ($_FILES[$field]['tmp_name']) {
                $fileType = mime_content_type($_FILES[$field]['tmp_name']);

                $file = $this->imageKit->uploadFile([
                    'file' => 'data:' . $fileType . ';base64,' . base64_encode(file_get_contents($_FILES[$field]['tmp_name'])),
                    'fileName' => 'picture',
                ]);

                ProductImage::create([
                    'image_url' => $file->result->url,
                    'product_id' => $product->id
                ]);
            }
        }
        return redirect()->route('products.index')->with('successAdd', 'Успешно додадовте продукт');
    }




    /**
     * Display the specified resources.
     */
    public function search(string $value)
    {
        $products = Product::where('name', 'LIKE', '%' . $value . '%')->paginate(8);
        return view('products.index', compact('products', 'value'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        $discounts = Discount::all();
        $tagValues = $product->tags->toArray();
        // Convert the array to a format expected by the input field
        $tagsArray = array_map(function ($value) {
            return ['value' => $value['name']];
        }, $tagValues);
        $jsonTags = json_encode($tagsArray);
        return view('products.edit-product', compact('product', 'sizes', 'colors', 'brands', 'discounts', 'jsonTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'size_hint' => $request->input('size_hint'),
            'maintenance_guidelines' => $request->input('maintenance_guidelines'),
            'brand_id' => $request->input('brand'),
            'category_id' => $request->input('category'),
            'discount_id' => $request->input('discount'),
            'status' => $request->input('status'),
        ]);
        $newsizes = [];
        if ($request->input('newsizes')) {
            foreach ($request->input('newsizes') as $newsize) {
                if (!Size::where('name', $newsize)->exists() && !empty($newsize)) {
                    $createdSize = Size::create(['name' => strtoupper($newsize)]);
                    $newsizes[] = $createdSize->id;
                }
            }
        }
        $sizes = array_merge($request->input('sizes'), $newsizes);
        $product->sizes()->sync($sizes);

        // syncing color_product table
        $product->colors()->sync($request->input('colors', []));


        // Extract tag values from the array of objects and syncing product_tag table
        $tagsArray = json_decode($request->input('tags'), true);
        $tagValues = array_map(function ($tag) {
            return $tag['value'];
        }, $tagsArray);
        $tags = [];
        foreach ($tagValues as $tagValue) {
            if (!Tag::where('name', $tagValue)->exists() && !empty($tagValue)) {
                $createdTag = Tag::create(['name' => strtoupper($tagValue)]);
                $tags[] = $createdTag->id;
            } else {
                $tagId = Tag::where('name', $tagValue)->pluck('id')->first();
                $tags[] = $tagId;
            }
        }
        $product->tags()->sync($tags);
        $imageFiles = ['edit_main_img', 'img_1', 'img_2', 'img_3'];

        foreach ($imageFiles as $key => $fileField) {
            if ($_FILES[$fileField]['tmp_name']) {
                $fileType = mime_content_type($_FILES[$fileField]['tmp_name']);

                $file = $this->imageKit->uploadFile([
                    'file' => 'data:' . $fileType . ';base64,' . base64_encode(file_get_contents($_FILES[$fileField]['tmp_name'])),
                    'fileName' => 'picture',
                ]);

                $productImage = ProductImage::where('product_id', $product->id)->skip($key)->first();

                if ($productImage) {
                    $productImage->update([
                        'image_url' => $file->result->url,
                        'product_id' => $product->id
                    ]);
                } else {
                    ProductImage::create([
                        'image_url' => $file->result->url,
                        'product_id' => $product->id
                    ]);
                }
            }
        }
        return redirect()->route('products.index')->with('successUpdate','Успешно го ажуриравте продуктот');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}

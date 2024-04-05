<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Brand;
use ImageKit\ImageKit;
use App\Models\Category;
use App\Models\Discount;
use App\Models\BrandImage;
use App\Http\Requests\BrandRequest;
use App\Models\Product;

class BrandController extends Controller
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
        $activeBrands = Brand::where('status', 1)->get();
        $archivedBrands = Brand::where('status', 0)->get();
        return view('brands.index', compact('activeBrands', 'archivedBrands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $discounts = Discount::all();
        $categories = Category::all();
        return view('brands.add-brand', compact('discounts', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $request->validate([
            'main_img' => 'required'
        ], [
            'main_img.required' => 'Првата слика е задолжителна.',
        ]);
        // creating brand
        $brand = Brand::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status') ?? 1,
        ]);
        // Extract tag values from the array of objects and syncing brand_tag table
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
        $brand->tags()->sync($tags);
        // store the images
        $imageFields = ['main_img', 'img_1', 'img_2', 'img_3'];
        foreach ($imageFields as $field) {
            if ($_FILES[$field]['tmp_name']) {
                $fileType = mime_content_type($_FILES[$field]['tmp_name']);

                $file = $this->imageKit->uploadFile([
                    'file' => 'data:' . $fileType . ';base64,' . base64_encode(file_get_contents($_FILES[$field]['tmp_name'])),
                    'fileName' => 'picture',
                ]);

                BrandImage::create([
                    'image_url' => $file->result->url,
                    'brand_id' => $brand->id
                ]);
            }
        }
        // syncing brand_category table
        $brand->categories()->sync($request->input('categories', []));

        return redirect()->route('brands.index')->with('successAdd', 'Успешно додадовте бренд');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $tagValues = $brand->tags->toArray();
        $categories = Category::all();
        // Convert the array to a format expected by the input field
        $tagsArray = array_map(function ($value) {
            return ['value' => $value['name']];
        }, $tagValues);
        $jsonTags = json_encode($tagsArray);
        return view('brands.edit-brand', compact('brand', 'categories', 'jsonTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {

        $brand->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ]);

        // syncing brand_category table
        $brand->categories()->sync($request->input('categories', []));


        // Extract tag values from the array of objects and syncing brand_tag table
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
        $brand->tags()->sync($tags);
        $imageFiles = ['edit_main_img', 'img_1', 'img_2', 'img_3'];

        foreach ($imageFiles as $key => $fileField) {

            if ($_FILES[$fileField]['tmp_name']) {
                $fileType = mime_content_type($_FILES[$fileField]['tmp_name']);

                $file = $this->imageKit->uploadFile([
                    'file' => 'data:' . $fileType . ';base64,' . base64_encode(file_get_contents($_FILES[$fileField]['tmp_name'])),
                    'fileName' => 'picture',
                ]);

                $brandImage = BrandImage::where('brand_id', $brand->id)->skip($key)->first();

                if ($brandImage) {
                    $brandImage->update([
                        'image_url' => $file->result->url,
                        'brand_id' => $brand->id
                    ]);
                } else {
                    BrandImage::create([
                        'image_url' => $file->result->url,
                        'brand_id' => $brand->id
                    ]);
                }
            }
        }
        return redirect()->route('brands.index')->with('successUpdate', 'Успешно го ажуриравте брендот');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $products = Product::all();
        foreach ($products as $product) {
            if ($product->brand_id == $brand->id) {
                return response()->json('error', 400);
            }
        }
        $brand->delete();
        return response()->json('success', 200);
    }
}

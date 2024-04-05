<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activeDiscounts = Discount::where('status', 1)->get();
        $archivedDiscounts = Discount::where('status', 0)->get();
        return view('discounts.index', compact('activeDiscounts', 'archivedDiscounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::all();
        return view('discounts.add-discount', compact('brands', 'categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountRequest $request)
    {
        $discount = Discount::create([
            'name' => $request->input('name'),
            'percentage' => $request->input('percentage'),
            'status' => $request->input('status') ?? 1
        ]);

        if ($request->input('discount_brands')) {
            foreach ($request->input('discount_brands') as $brandId) {
                Product::where('brand_id', $brandId)->update(['discount_id' => $discount->id]);
            }
        }

        if ($request->input('discount_categories')) {
            foreach ($request->input('discount_categories') as $categoryId) {
                Product::where('category_id', $categoryId)->update(['discount_id' => $discount->id]);
            }
        }

        if ($request->input('discount_products')) {
            foreach ($request->input('discount_products') as $productId) {
                Product::where('id', $productId)->update(['discount_id' => $discount->id]);
            }
        }
        return redirect()->route('discounts.index')->with('successAdd','Успешно додавте попуст');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::all();
        return view('discounts.edit-discount', compact('discount', 'brands', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountRequest $request, Discount $discount)
    {
        $discount->update([
            'name' => $request->input('name'),
            'percentage' => $request->input('percentage'),
            'status' => $request->input('status'),
        ]);

        Product::where('discount_id', $discount->id)->update(['discount_id' => null]);
        if ($request->input('discount_products')) {
            foreach ($request->input('discount_products') as $productId) {
                Product::where('id', $productId)->update(['discount_id' => $discount->id]);
            }
        }
        
        if ($request->input('discount_brands')) {
            foreach ($request->input('discount_brands') as $brandId) {
                Product::where('brand_id', $brandId)->update(['discount_id' => $discount->id]);
            }
        }

        if ($request->input('discount_categories')) {
            foreach ($request->input('discount_categories') as $categoryId) {
                Product::where('category_id', $categoryId)->update(['discount_id' => $discount->id]);
            }
        }
        return redirect()->route('discounts.index')->with('successUpdate','Успешно го ажуриравте попустот');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
    }
}

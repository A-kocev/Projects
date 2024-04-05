<?php

namespace App\Http\Controllers\Admin;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('discounts.index', compact('discounts'));
    }

    public function create()
    {
        $code = Str::random(10);

        return view('discounts.create', compact('code'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'discount_code' => 'required|unique:discounts,discount_code|max:255',
            'percentage' => 'required|numeric|min:0|max:100', 
        ]);

        Discount::create($validated);

        return redirect()->route('discounts.index')->with('successAdd', 'Discount created successfully.');
    }

    public function edit(Discount $discount)
    {
        return view('discounts.edit', compact('discount'));
    }

    public function update(Request $request, Discount $discount)
    {
        $validated = $request->validate([
            'discount_code' => 'required|unique:discounts,discount_code,'.$discount->id,
            'percentage' => 'required|numeric|min:0|max:100', 
        ]);

        $discount->update($validated);

        return redirect()->route('discounts.index')->with('successEdit', 'Discount updated successfully.');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('discounts.index')->with('successDelete', 'Discount deleted successfully.');
    }
}

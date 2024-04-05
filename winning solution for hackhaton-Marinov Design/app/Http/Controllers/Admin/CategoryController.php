<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);

    }
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(Request $request)
{
    
    $validatedData = $request->validate([
        'name' => 'required|string|max:255', 
    ]);

    $category = Category::create($validatedData);

    return response()->json($category, 201);
}


    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', 
        ]);
    
        $category = Category::findOrFail($id);
        $category->update($validatedData);
        return response()->json($category);
    }
    

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json('Category deleted successfully');
    }
}

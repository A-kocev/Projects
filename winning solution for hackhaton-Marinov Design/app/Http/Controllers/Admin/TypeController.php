<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Category;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::with('category')->get();
        return view('types.all-types', compact('types'));
    }


    public function create()
    {
        $categories = Category::all();

        return view('types.create', compact('categories'));
    }

    public function show($id)
    {
        $type = Type::findOrFail($id);

        return view('types.all-types', compact('type'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        Type::create($validatedData);
        return redirect()->route('types.index')->with('successAdd', 'Type created successfully.');
    }

    public function edit($id)
    {
        $type = Type::findOrFail($id);
        $categories = Category::all();
        return view('types.edit', compact('type', 'categories'));
    }




    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);


        $type = Type::findOrFail($id);


        $type->update($validatedData);


        return redirect()->route('types.index')->with('successEdit', 'Type updated successfully.');
    }

    public function destroy(Type $type)
    {
        $products = Product::all();
        foreach ($products as $product) {
            if ($product->type_id == $type->id) {
                return redirect()->route('types.index')->with('errorDelete', 'Cannot delete this type, there are already products from this type.');
            }
        }

        $type->delete();
        return redirect()->route('types.index')->with('successDelete', 'Type deleted successfully.');


    }

}


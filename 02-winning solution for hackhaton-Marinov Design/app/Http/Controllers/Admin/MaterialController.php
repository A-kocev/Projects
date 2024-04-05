<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();

        return view('materials.all-materials', compact('materials'));
    }

    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $material = Material::create($validatedData);

        return redirect()->route('materials.index')->with('successAdd', 'Material added successfully.');
    }

    public function show($id)
    {
        $material = Material::findOrFail($id);
        return response()->json($material);
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);

        return view('materials.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $material = Material::findOrFail($id);
        
        $material->update($validatedData);

        // Redirect the user to the materials index page with a success message
        return redirect()->route('materials.index')->with('successEdit', 'Material updated successfully.');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return redirect()->route('materials.index')->with('successDelete', 'Material deleted successfully.');
    }
}

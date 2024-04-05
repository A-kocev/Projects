<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::all();
        return view('maintenances.all-maintenances', compact('maintenances'));
    }

    public function create()
    {
        return view('maintenances.add-maintenance');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $maintenance = Maintenance::create($validated);

        if ($request->expectsJson()) {
            return response()->json($maintenance, 201);
        }

        return redirect()->route('maintenances.index')->with('successAdd', 'Maintenance created successfully');
    }

    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        return view('maintenances.add-maintenance', compact('maintenance'));
    }

    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
        ]);

        $maintenance->update($validated);
        return redirect()->route('maintenances.index')->with('successEdit', 'Maintanence updated successfully.');
    }

    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();
        return redirect()->route('maintenances.index')->with('successDelete', 'Maintanence deleted successfully.');
    }
}

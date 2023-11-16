<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipments = Equipment::paginate(5);
        return view('admin.equipments.index', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        return view('admin.equipments.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        return view('admin.equipments.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $equipment->update($validatedData);

        return redirect()->route('admin.equipments.show', $equipment)->with('success', 'Equipments updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->deleteOrFail();

        return redirect()->route('admin.equipments')->with('success', 'Equipments deleted successfully.');
    }
}

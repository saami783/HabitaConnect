<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announce;
use Illuminate\Http\Request;

class AnnounceCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announces = Announce::paginate(10);
        return view('admin.announces.index', compact('announces'));
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
    public function show(Announce $announce)
    {
        return view('admin.announces.show', compact('announce'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announce $announce)
    {
        return view('admin.announces.edit', compact('announce'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announce $announce)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'address' => 'required|max:255',
            'price_per_night' => 'required|numeric',
            'type' => 'required|in:house,apartment,room',
        ]);

        $announce->update($validatedData);

        return redirect()->route('admin.announces.show', $announce)->with('success', 'Announce updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announce $announce)
    {
        $announce->deleteOrFail();

        return redirect()->route('admin.announces')->with('success', 'Announce deleted successfully.');
    }
}

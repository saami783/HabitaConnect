<?php

namespace App\Http\Controllers\Announce;

use App\Http\Controllers\Controller;
use App\Models\Announce;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Models\User;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announces = Announce::all();
        return view('announces.index', compact('announces'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Announce $announce)
    {
        return view('announces.show', ['announce' => $announce]);
    }

    /**
     * Show the form for creating a new resource.
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Announce::class);
        return view('announces.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'address' => 'required|max:255',
            'price_per_night' => 'required|numeric',
            'type' => 'required|in:house,apartment,room',
        ]);

        $announce = new Announce;
        $announce->title = $request->title;
        $announce->description = $request->description;
        $announce->address = $request->address;
        $announce->price_per_night = $request->price_per_night;
        $announce->type = $request->type;
        $announce->user_id = auth()->id();
        $announce->save();

        return redirect()->route('announces.index')->with('success', 'Announce created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(Announce $announce)
    {
        // Si l'utilisateur a le droit de modifier cette annonce
        $this->authorize('update', $announce);

        return view('announces.edit', compact('announce'));
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(Request $request, Announce $announce)
    {
        $this->authorize('update', $announce);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'address' => 'required|max:255',
            'price_per_night' => 'required|numeric',
            'type' => 'required|in:house,apartment,room',
        ]);

        // Mets à jour l'annonce avec les données validées
        $announce->update($validatedData);

        return redirect()->route('announces.show', $announce)->with('success', 'Announce updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     * @throws \Throwable
     */
    public function destroy(Announce $announce)
    {
        $this->authorize('delete', $announce);
        $announce->deleteOrFail();

        return redirect()->route('announces.index')->with('success', 'Announce deleted successfully.');
    }
}

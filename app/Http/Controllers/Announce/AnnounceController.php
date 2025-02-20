<?php

namespace App\Http\Controllers\Announce;

use App\Http\Controllers\Controller;
use App\Models\Announce;
use App\Models\Equipment;
use App\Models\File;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announces = Announce::with('files')->paginate(10);

        return view('announces.index', compact('announces'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Announce $announce)
    {
        $announce->load('files');

        return view('announces.show', [
            'announce' => $announce,
            'equipments' => $announce->equipments,
            'reviews' => $announce->reviews
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Announce::class);
        $equipments = Equipment::all();
        return view('announces.create', ['equipments' => $equipments]);
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
            'files' => 'required|array',
            'files.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'equipments' => 'required|array',
            'equipments.*' => 'exists:equipments,id',
        ]);

        $user = Auth::id();

        $announce = new Announce;
        $announce->title = $request->title;
        $announce->description = $request->description;
        $announce->address = $request->address;
        $announce->price_per_night = $request->price_per_night;
        $announce->type = $request->type;
        $announce->user_id = auth()->id();
        $announce->save();

        if ($request->has('equipments')) {
            $announce->equipments()->sync($request->equipments);
        }

        $fileModel = new File;

        if($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads' . '/annonces/' . 'users/' . "user_$user" . "/annonces_$announce->id", $fileName, 'public');

                $fileModel = new File;
                $fileModel->name = $fileName;
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->announce_id = $announce->id;
                $fileModel->saveOrFail();
            }
            return back()
                ->with('success','File has been uploaded.');
        }
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

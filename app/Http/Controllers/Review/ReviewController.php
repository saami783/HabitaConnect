<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Models\Announce;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $announce =  Announce::find($request->announce_id);
        dd($announce);
        $this->authorize('store',);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'address' => 'required|max:255',
            'price_per_night' => 'required|numeric',
            'type' => 'required|in:house,apartment,room',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review, Announce $announce)
    {
        $review->deleteOrFail();
        return view('announces.show', $announce);
    }
}

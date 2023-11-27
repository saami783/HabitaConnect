<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Models\Announce;
use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {

        $announce =  Announce::find($request->announce_id);

        $this->authorize('create', [Review::class, $announce]);

        $validatedData = $request->validate([
            'review_content' => ['required', 'string', 'max:255'],
            'note' => ['required', 'numeric', 'min:1', 'max:5'],
        ]);

        $review = new Review();
        $review->content = $request->review_content;
        $review->note = $request->note;
        $review->user_id = $request->user()->id;
        $review->announce_id = $announce->id;
        $review->saveOrFail();

        return redirect()->route('announces.show', $announce)->with('success', 'Votre avis a bien été posté!');
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->deleteOrFail();

        return redirect()->route('admin.reviews')->with('success', 'Review deleted successfully.');
    }
}

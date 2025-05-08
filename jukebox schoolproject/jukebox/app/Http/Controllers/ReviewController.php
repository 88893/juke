<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Song $song): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'reviewer_name' => 'nullable|string|max:255',
        ]);

        $song->reviews()->create([
            'content' => $request->content,
            'reviewer_name' => $request->reviewer_name ?? 'Anoniem',
        ]);

        return redirect()->route('songs.show', $song)
            ->with('success', 'Review is succesvol toegevoegd.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review): RedirectResponse
    {
        $song = $review->song;
        $review->delete();

        return redirect()->route('songs.show', $song)
            ->with('success', 'Review is succesvol verwijderd.');
    }
}

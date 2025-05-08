<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    /**
     * Toon een lijst van alle resources.
     */
    public function index()
    {
        //
    }

    /**
     * Toon het formulier voor het maken van een nieuwe resource.
     */
    public function create()
    {
        //
    }

    /**
     * Sla een nieuw aangemaakte resource op.
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
     * Toon de gespecificeerde resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Toon het formulier voor het bewerken van de gespecificeerde resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update de gespecificeerde resource.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Verwijder de gespecificeerde resource.
     */
    public function destroy(Review $review): RedirectResponse
    {
        $song = $review->song;
        $review->delete();

        return redirect()->route('songs.show', $song)
            ->with('success', 'Review is succesvol verwijderd.');
    }
}

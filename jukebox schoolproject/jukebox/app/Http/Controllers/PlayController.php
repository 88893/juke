<?php

namespace App\Http\Controllers;

use App\Models\Play;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlayController extends Controller
{
    /**
     * Toon een lijst van alle afgespeelde liedjes.
     */
    public function index(): View
    {
        $plays = Play::with('song')->latest('played_at')->get();
        return view('plays.index', compact('plays'));
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
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Play;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SongController extends Controller
{
    /**
     * Toon een lijst van alle liedjes.
     */
    public function index(): View
    {
        $songs = Song::orderBy('title')->get();
        return view('songs.index', compact('songs'));
    }

    /**
     * Toon het formulier voor het maken van een nieuw liedje.
     */
    public function create(): View
    {
        return view('songs.create');
    }

    /**
     * Sla een nieuw liedje op.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'music_file' => 'required|file|mimes:mp3,wav,ogg|max:10240',
            'image_file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload en sla het muziekbestand op
        $musicFileName = time() . '_' . $request->file('music_file')->getClientOriginalName();
        $request->file('music_file')->move(public_path('music'), $musicFileName);

        // Upload en sla de afbeelding op
        $imageFileName = time() . '_' . $request->file('image_file')->getClientOriginalName();
        $request->file('image_file')->move(public_path('images'), $imageFileName);

        Song::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'file_path' => 'music/' . $musicFileName,
            'image_path' => 'images/' . $imageFileName,
            'play_count' => 0,
        ]);

        return redirect()->route('songs.index')
            ->with('success', 'Liedje is succesvol toegevoegd.');
    }

    /**
     * Toon een specifiek liedje.
     */
    public function show(Song $song): View
    {
        // Log het afspelen van dit liedje
        Play::create([
            'song_id' => $song->id,
            'played_at' => now(),
        ]);

        // Verhoog de afspeelteller
        $song->incrementPlayCount();

        // Haal de reviews op
        $reviews = $song->reviews()->latest()->get();

        return view('songs.show', compact('song', 'reviews'));
    }

    /**
     * Toon het formulier voor het bewerken van een liedje.
     */
    public function edit(Song $song): View
    {
        return view('songs.edit', compact('song'));
    }

    /**
     * Update een liedje.
     */
    public function update(Request $request, Song $song)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'music_file' => 'nullable|file|mimes:mp3,wav,ogg|max:10240',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $songData = [
            'title' => $request->title,
            'artist' => $request->artist,
        ];

        // Controleer of er een nieuw muziekbestand is geüpload
        if ($request->hasFile('music_file')) {
            // Verwijder het oude bestand als het bestaat
            if (file_exists(public_path($song->file_path))) {
                unlink(public_path($song->file_path));
            }

            // Upload en sla het nieuwe muziekbestand op
            $musicFileName = time() . '_' . $request->file('music_file')->getClientOriginalName();
            $request->file('music_file')->move(public_path('music'), $musicFileName);
            $songData['file_path'] = 'music/' . $musicFileName;
        }

        // Controleer of er een nieuwe afbeelding is geüpload
        if ($request->hasFile('image_file')) {
            // Verwijder de oude afbeelding als deze bestaat
            if (file_exists(public_path($song->image_path))) {
                unlink(public_path($song->image_path));
            }

            // Upload en sla de nieuwe afbeelding op
            $imageFileName = time() . '_' . $request->file('image_file')->getClientOriginalName();
            $request->file('image_file')->move(public_path('images'), $imageFileName);
            $songData['image_path'] = 'images/' . $imageFileName;
        }

        $song->update($songData);

        return redirect()->route('songs.index')
            ->with('success', 'Liedje is succesvol bijgewerkt.');
    }

    /**
     * Verwijder een liedje.
     */
    public function destroy(Song $song)
    {
        // Verwijder de bestanden
        if (file_exists(public_path($song->file_path))) {
            unlink(public_path($song->file_path));
        }

        if (file_exists(public_path($song->image_path))) {
            unlink(public_path($song->image_path));
        }

        $song->delete();

        return redirect()->route('songs.index')
            ->with('success', 'Liedje is succesvol verwijderd.');
    }

    /**
     * Toon statistieken over afgespeelde liedjes.
     */
    public function statistics(): View
    {
        $songs = Song::orderBy('play_count', 'desc')->get();
        return view('songs.statistics', compact('songs'));
    }
}

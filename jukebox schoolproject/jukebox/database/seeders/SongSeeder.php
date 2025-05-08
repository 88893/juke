<?php

namespace Database\Seeders;

use App\Models\Song;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Maak de benodigde directories als ze nog niet bestaan
        if (!File::exists(public_path('music'))) {
            File::makeDirectory(public_path('music'), 0755, true);
        }
        
        if (!File::exists(public_path('images'))) {
            File::makeDirectory(public_path('images'), 0755, true);
        }
        
        // Voorbeeld songs
        $songs = [
            [
                'title' => 'Bohemian Rhapsody',
                'artist' => 'Queen',
                'file_path' => 'music/sample_1.mp3',
                'image_path' => 'images/sample_1.jpg',
                'play_count' => 12,
                'reviews' => [
                    [
                        'content' => 'Geweldig nummer, een klassieker!',
                        'reviewer_name' => 'Muziekliefhebber'
                    ],
                    [
                        'content' => 'Mijn favoriete nummer aller tijden.',
                        'reviewer_name' => 'Queen Fan'
                    ]
                ]
            ],
            [
                'title' => 'Imagine',
                'artist' => 'John Lennon',
                'file_path' => 'music/sample_2.mp3',
                'image_path' => 'images/sample_2.jpg',
                'play_count' => 8,
                'reviews' => [
                    [
                        'content' => 'Zo\'n inspirerend nummer met een mooie boodschap.',
                        'reviewer_name' => 'Vredeszoeker'
                    ]
                ]
            ],
            [
                'title' => 'Billie Jean',
                'artist' => 'Michael Jackson',
                'file_path' => 'music/sample_3.mp3',
                'image_path' => 'images/sample_3.jpg',
                'play_count' => 15,
                'reviews' => [
                    [
                        'content' => 'Je kunt niet stilzitten bij dit nummer!',
                        'reviewer_name' => 'Danser'
                    ],
                    [
                        'content' => 'Tijdloze klassieker van de King of Pop.',
                        'reviewer_name' => 'MJ Fan'
                    ],
                    [
                        'content' => 'Die baslijn is ongeëvenaard.',
                        'reviewer_name' => 'Muziekproducer'
                    ]
                ]
            ],
            [
                'title' => 'Hotel California',
                'artist' => 'Eagles',
                'file_path' => 'music/sample_4.mp3',
                'image_path' => 'images/sample_4.jpg',
                'play_count' => 10,
                'reviews' => [
                    [
                        'content' => 'Die gitaarsolo is legendarisch!',
                        'reviewer_name' => 'Gitarist'
                    ]
                ]
            ],
            [
                'title' => 'Sweet Child O\' Mine',
                'artist' => 'Guns N\' Roses',
                'file_path' => 'music/sample_5.mp3',
                'image_path' => 'images/sample_5.jpg',
                'play_count' => 7,
                'reviews' => [
                    [
                        'content' => 'Beste rocknummer aller tijden.',
                        'reviewer_name' => 'Rocker'
                    ],
                    [
                        'content' => 'Die intro gitaar riff is onmiddellijk herkenbaar.',
                        'reviewer_name' => 'Rockfan'
                    ]
                ]
            ],
        ];
        
        // Voeg de songs toe aan de database
        foreach ($songs as $songData) {
            $reviews = $songData['reviews'];
            unset($songData['reviews']);
            
            // Maak het liedje aan
            $song = Song::create($songData);
            
            // Voeg reviews toe
            foreach ($reviews as $reviewData) {
                $song->reviews()->create($reviewData);
            }
            
            // Voeg enkele afspeel-logs toe
            for ($i = 0; $i < mt_rand(1, 5); $i++) {
                $song->plays()->create([
                    'played_at' => now()->subDays(mt_rand(0, 30))->subHours(mt_rand(0, 24)),
                ]);
            }
            
            // Kopieer voorbeeldbestanden als deze bestaan
            $sampleMusicPath = database_path('samples/music/' . basename($songData['file_path']));
            $sampleImagePath = database_path('samples/images/' . basename($songData['image_path']));
            
            if (File::exists($sampleMusicPath)) {
                File::copy($sampleMusicPath, public_path($songData['file_path']));
            } else {
                // Maak een leeg bestand aan als voorbeeld
                File::put(public_path($songData['file_path']), 'Sample music file');
            }
            
            if (File::exists($sampleImagePath)) {
                File::copy($sampleImagePath, public_path($songData['image_path']));
            } else {
                // Maak een leeg bestand aan als voorbeeld
                File::put(public_path($songData['image_path']), 'Sample image file');
            }
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Song extends Model
{
    /**
     * De attributen die massaal toegewezen kunnen worden.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'artist',
        'file_path',
        'image_path',
        'play_count',
    ];

    /**
     * Verkrijg de reviews voor dit liedje.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Verkrijg de afspeel-logs voor dit liedje.
     */
    public function plays(): HasMany
    {
        return $this->hasMany(Play::class);
    }

    /**
     * Incrementeer de afspeelteller van het liedje.
     */
    public function incrementPlayCount(): void
    {
        $this->increment('play_count');
    }
}

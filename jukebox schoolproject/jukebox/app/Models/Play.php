<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Play extends Model
{
    /**
     * De attributen die massaal toegewezen kunnen worden.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'song_id',
        'played_at',
    ];

    /**
     * De attributen die naar datumtypen moeten worden gecast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'played_at' => 'datetime',
    ];

    /**
     * Verkrijg het liedje dat bij deze afspeel-log hoort.
     */
    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }
}

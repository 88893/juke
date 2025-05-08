<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    /**
     * De attributen die massaal toegewezen kunnen worden.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'song_id',
        'content',
        'reviewer_name',
    ];

    /**
     * Verkrijg het liedje dat bij deze review hoort.
     */
    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }
}

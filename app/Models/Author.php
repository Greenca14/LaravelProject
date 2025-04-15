<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Author extends Model
{
    protected $fillable = ['publication_id', 'person_id', 'contribution_share'];
 
    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}

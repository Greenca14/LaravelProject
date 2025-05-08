<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['journal_id', 'title', 'publication_date'];

    protected $casts = [
        'publication_date' => 'date:Y-m-d',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function journal(): BelongsTo
    {
        return $this->belongsTo(Journal::class);
    }
 
    public function authors(): HasMany
    {
        return $this->hasMany(Author::class);
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'authors')
                    ->withPivot('contribution_share');
    }
}
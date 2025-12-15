<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    protected $table = 'persons';

    protected $fillable = ['full_name', 'birth_date', 'avatar'];

    protected $casts = [
        'birth_date' => 'date:Y-m-d',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
 
    public function authors(): HasMany
    {
        return $this->hasMany(Author::class);
    }

    public function publications()
    {
        return $this->belongsToMany(Publication::class, 'authors')
                    ->withPivot('contribution_share');
    }
}
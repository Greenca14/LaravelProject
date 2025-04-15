<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Journal extends Model
{
    protected $fillable = ['name'];
 
    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }
}
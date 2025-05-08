<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journal extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];
 
    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }
}
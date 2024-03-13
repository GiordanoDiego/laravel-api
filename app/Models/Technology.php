<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug'
    ];

    /*
        Relationships
    */
    // Many-to-Many to Projects
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}

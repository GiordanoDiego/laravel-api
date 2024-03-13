<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "slug",
    ];

    
    //One to many - non importo il model di type perchè hanno lo stesso namespace
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

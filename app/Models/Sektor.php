<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 
        'name', 
        'description'
    ];

    public function project()
    {
        return $this->hasMany(Project::class, 'sektor_id');
    }
}
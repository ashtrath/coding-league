<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    use HasFactory, HasUlids;

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
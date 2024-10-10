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

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
}

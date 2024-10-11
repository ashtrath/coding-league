<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'title',
        'content',
        'description',
        'image',
        'status'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

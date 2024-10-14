<?php

namespace App\Models;

use App\Enums\KegiatanStatus;
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
        'status',
        'tanggal_diterbitkan'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value;

        if ($value === KegiatanStatus::Terbit->value) {
            $this->attributes['tanggal_diterbitkan'] = now();
        } else {
            $this->attributes['tanggal_diterbitkan'] = null;
        }
    }
}

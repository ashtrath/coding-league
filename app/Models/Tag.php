<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name', 
        'kegiatan_id'
    ];

    public function kegiatans() 
    {
        return $this->belongsToMany(Kegiatan::class);
    }

    public function laporans()
    {  
        return $this->belongsToMany(Laporan::class, 'laporan_tag', 'tag_id', 'laporan_id');
    }
}

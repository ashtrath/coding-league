<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageLaporan extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['image', 'laporan_id'];

    public function laporan() 
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }
}

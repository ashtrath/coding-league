<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageLaporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'laporan_id'
    ];
}

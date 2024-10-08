<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'lokasi_kecamatan',
        'tanggal_awal',
        'tanggal_akhir',
        'tanggal_diterbitkan',
        'sektor_id',

    ];

    public function sektor()
    {
        return $this->belongsTo(Sektor::class, 'sektor_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'title',
        'status',
        'description',
        'anggaran_realisasi',
        'tanggal_realisasi',
        'tanggal_diterbitkan',
        'lokasi_kecamatan',
        'mitra_id',
        'sektor_id',
        'project_id',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

    public function sektor()
    {
        return $this->belongsTo(Sektor::class, 'sektor_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function images()
    {
        return $this->hasMany(ImageLaporan::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'laporan_tag', 'laporan_id', 'tag_id');
    }
}

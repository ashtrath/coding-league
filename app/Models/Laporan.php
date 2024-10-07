<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'description',
        'anggaran_realisasi',
        'tanggal_realisasi',
        'sektor_id',
        'project_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sektor()
    {
        return $this->belongsTo(Sektor::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

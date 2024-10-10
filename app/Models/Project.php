<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory, HasUlids;

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

    protected $casts = [
        'tanggal_awal' => 'date',
        'tanggal_akhir' => 'date'
    ];

    public function sektor(): BelongsTo
    {
        return $this->belongsTo(Sektor::class, 'sektor_id');
    }

    public function laporans(): HasMany
    {
        return $this->hasMany(Laporan::class, 'project_id');
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value;

        if ($value === ProjectStatus::Terbit->value) {
            $this->attributes['tanggal_diterbitkan'] = now();
        } else {
            $this->attributes['tanggal_diterbitkan'] = null;
        }
    }
}

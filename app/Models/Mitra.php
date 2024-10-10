<?php

namespace App\Models;

use App\Enums\MitraStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'user_id',
        'name_mitra',
        'name_company',
        'phone_number',
        'address',
        'status',
    ];

    protected $casts = [
        'status' => MitraStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

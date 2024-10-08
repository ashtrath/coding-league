<?php

namespace App\Models;

use App\Enums\MitraStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'mitra';

    protected $fillable = [
        'name_mitra',
        'name_company',
        'phone_number',
        'address',
        'status',
    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }
}

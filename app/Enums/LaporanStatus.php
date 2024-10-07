<?php

namespace App\Enums;

enum LaporanStatus: string
{
    case Diterima = 'Diterima';
    case Ditolak = 'Ditolak';
    case Revisi = 'Revisi';
    case Pending = 'Pending';
    case Draft = 'Draft';
}

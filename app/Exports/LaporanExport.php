<?php

namespace App\Exports;

use App\Models\YourModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromCollection
{
    protected $laporan;

    public function __construct($laporan)
    {
        $this->laporan = $laporan;
    }

    public function collection()
    {
        return $this->laporan;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Description',
            'Status',
            'Anggaran Realisasi',
            'Tanggal Realisasi',
        ];
    }
}
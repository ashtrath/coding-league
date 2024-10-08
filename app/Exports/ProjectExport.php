<?php

namespace App\Exports;

use App\Models\YourModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjectExport implements FromCollection
{
    protected $project;

    public function __construct($project)
    {
        $this->project = $project;
    }

    public function collection()
    {
        return $this->project;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Description',
            'Image',
            'Lokasi Kecamatan',
            'Tanggal Awal',
            'Tanggal Akhir',
            'Tanggal Diterbitkan',
            'Status'
        ];
    }
}
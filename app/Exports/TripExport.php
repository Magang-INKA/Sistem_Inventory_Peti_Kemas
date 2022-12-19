<?php

namespace App\Exports;

use App\Models\Trip as ModelsTrip;
use App\Trip;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TripExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModelsTrip::all();
    }
    public function headings() : array
    {
        return [
            'ID',
            'Nama Trip',
            'ID Pelabuhan Asal',
            'ID Pelabuhan Tujuan',
            'ID Kapal',
            'Created_at',
            'Updated_at'
        ];
    }
}

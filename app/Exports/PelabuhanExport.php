<?php

namespace App\Exports;

use App\Models\Pelabuhan as ModelsPelabuhan;
use App\Pelabuhan;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PelabuhanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModelsPelabuhan::all();
    }
    public function headings() : array
    {
        return [
            'Port Code',
            'Port Name',
            'Address',
            'Created_at',
            'Updated_at'
        ];
    }
}

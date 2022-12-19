<?php

namespace App\Exports;

use App\Models\MasterKapal as ModelsMasterKapal;
use App\MasterKapal;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MasterKapalExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModelsMasterKapal::all();
    }
    public function headings() : array
    {
        return [
            'Vessel ID',
            'IMO',
            'Vessel Name',
            'Created_at',
            'Updated_at'
        ];
    }
}

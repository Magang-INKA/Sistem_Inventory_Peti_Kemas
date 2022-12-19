<?php

namespace App\Exports;

use App\Models\MasterContainer as ModelsMasterContainer;
use App\MasterContainer;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MasterContainerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModelsMasterContainer::all();
    }
    public function headings() : array
    {
        return [
            'Container Code',
            'Container Type',
            'Capacity',
            'Temperature',
            'Created_at',
            'Updated_at'
        ];
    }
}

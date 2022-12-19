<?php

namespace App\Exports;

use App\Models\Container as ModelsContainer;
use App\Container;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContainerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModelsContainer::all();
    }
    public function headings() : array
    {
        return [
            'ID',
            'no_container',
            'id_kapal',
            'Created_at',
            'Updated_at'
        ];
    }
}

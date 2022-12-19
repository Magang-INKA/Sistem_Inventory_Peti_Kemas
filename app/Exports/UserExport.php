<?php

namespace App\Exports;

use App\Models\User as ModelsUser;
use App\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModelsUser::all();
    }
    public function headings() : array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'No Telepon',
            'Gambar',
            'Role',
            'Created_at',
            'Updated_at'
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Transaksi as ModelsTransaksi;
use App\Transaksi;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransaksiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModelsTransaksi::all();
    }
    public function headings() : array
    {
        return [
            'ID',
            'ID Booking',
            'Biaya',
            'Qrcode',
            'Created_at',
            'Updated_at'
        ];
    }
}

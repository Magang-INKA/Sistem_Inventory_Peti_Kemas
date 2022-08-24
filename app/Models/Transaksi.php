<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class Transaksi extends Model
{
    use HasFactory;
    protected $table="transaksi"; // Eloquent akan membuat model Transaksi menyimpan record di tabel transaksi
    protected $primaryKey = 'kode'; // Memanggil isi DB Dengan primarykey
    public $incrementing =false;

    protected $fillable = [
        'kode',
        'nama',
        'alamat',
        'telp',
        'kota',
        'penyedia',
    ];
    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Container;
use App\Models\Booking;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;

class Barang extends Model
{
    use HasFactory;
    protected $table="master_barang"; // Eloquent akan membuat model Barang menyimpan record di tabel barang
    protected $primaryKey = 'id'; // Memanggil isi DB Dengan primarykey
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'id',
        'nama_barang',
<<<<<<< HEAD
        'jenis_barang',
        'berat_barang',
=======
        'berat',
        'gambar',
>>>>>>> 1dcda2e8751c7eea44fd07769742d99413e4c353
    ];

    // public function container()
    // {
    //     return $this->belongsTo(Container::class, 'id_container');
    // }
    public function BarangKeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }
    public function BarangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}

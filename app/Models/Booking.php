<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Container;
use App\Models\User;
use App\Models\Kapal;
use App\Models\Pelabuhan;
use App\Models\Barang;

class Booking extends Model
{
    use HasFactory;
    protected $table="booking"; // Eloquent akan membuat model Barang menyimpan record di tabel barang
    protected $primaryKey = 'id'; // Memanggil isi DB Dengan primarykey
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'id',
        'no_resi',
        'id_user',
        'id_jadwal',
        'id_container',
        'id_barang',
        'id_container',
        'date',
        'status',
        'nama_penerima',
        'telp_penerima',
        'alamat_penerima',
    ];

    public function jadwalKapal()
    {
        return $this->belongsTo(JadwalKapal::class, 'id_jadwal');
    }
    public function container()
    {
        return $this->belongsTo(Container::class, 'id_container');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function pelabuhan()
    {
        return $this->belongsTo(Pelabuhan::class, 'id_pelabuhan');
    }
}

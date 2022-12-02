<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kapal;
use App\Models\Container;
use App\Models\Trip;
use App\Models\JadwalKapal;

class Pelabuhan extends Model
{
    use HasFactory;
    protected $table="master_pelabuhan"; // Eloquent akan membuat model Container menyimpan record di tabel container
    protected $primaryKey = 'kode_pelabuhan'; // Memanggil isi DB Dengan primarykey
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'kode_pelabuhan',
        'nama_pelabuhan',
        'alamat'
    ];

    public function kapal()
    {
        return $this->belongsTo(Kapal::class);
    }

    public function container()
    {
        return $this->hasMany(Container::class);
    }

    public function trip()
    {
        return $this->hasMany(Trip::class);
    }

    public function jadwalKapal()
    {
        return $this->belongsTo(JadwalKapal::class);
    }
}

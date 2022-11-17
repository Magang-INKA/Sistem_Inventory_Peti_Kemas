<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;
use App\Models\MasterKapal;
use App\Models\Pelabuhan;

class JadwalKapal extends Model
{
    use HasFactory;
    protected $table="jadwal_kapal"; // Eloquent akan membuat model JadwalKapal menyimpan record di tabel jadwal_kapal
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_kapal',
        'id_trip',
        'ETA',
        'ETD',
    ];

    public function trip()
    {
        return $this->hasOne(Trip::class, 'id','id_trip');
    }
    public function kapal()
    {
        return $this->hasOne(MasterKapal::class, 'no_kapal','id_kapal');
    }

    public function keberangkatan()
    {
        return $this->hasOne(Pelabuhan::class, 'kode_pelabuhan', 'asal_pelabuhan_id');
    }

    public function tujuan()
    {
        return $this->hasOne(Pelabuhan::class, 'kode_pelabuhan' , 'final_pelabuhan_id');
    }
}

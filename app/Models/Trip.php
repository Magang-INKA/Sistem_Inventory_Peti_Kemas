<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelabuhan;
use App\Models\MasterKapal;
use App\Models\JadwalKapal;

class Trip extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table="trip"; // Eloquent akan membuat model Trip menyimpan record di tabel trip
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_trip',
        'asal_pelabuhan_id',
        'final_pelabuhan_id',
        'id_kapal',
    ];

    public function keberangkatan()
    {
        return $this->hasOne(Pelabuhan::class, 'kode_pelabuhan', 'asal_pelabuhan_id');
    }

    public function tujuan()
    {
        return $this->hasOne(Pelabuhan::class, 'kode_pelabuhan' , 'final_pelabuhan_id');
    }

    public function kapal()
    {
        return $this->hasOne(MasterKapal::class, 'id' , 'id_kapal');
    }
    public function jadwalKapal()
    {
        return $this->belongsTo(JadwalKapal::class);
    }
}

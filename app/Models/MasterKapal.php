<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kapal;
use App\Models\Trip;
use App\Models\Container;
use App\Models\JadwalKapal;

class MasterKapal extends Model
{
    use HasFactory;
    protected $table="master_kapal"; // Eloquent akan membuat model Container menyimpan record di tabel container
    protected $primaryKey = 'no_kapal'; // Memanggil isi DB Dengan primarykey
    public $incrementing =false;
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'no_kapal',
        'nama_kapal',
    ];

    public function kapal()
    {
        return $this->belongsTo(Kapal::class, 'no_kapal');
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
        return $this->hasMany(JadwalKapal::class);
    }
}

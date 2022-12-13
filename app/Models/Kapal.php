<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Container;
use App\Models\Pelabuhan;
use App\Models\MasterKapal;

class Kapal extends Model
{
    use HasFactory;
    protected $table="kapal"; // Eloquent akan membuat model Container menyimpan record di tabel container
    protected $primaryKey = 'id'; // Memanggil isi DB Dengan primarykey
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_keberangkatan',
        'id_tujuan',
        'IMO',
        'jadwal',
    ];

    public function pelabuhan()
    {
        // return $this->hasMany(Pelabuhan::class)->where('id_tujuan', '=', $this->id_tujuan)->where('id_keberangkatan', '=', $this->id_keberangkatan);
        return $this->hasOne(Pelabuhan::class, 'id', 'id_keberangkatan');
    }

    public function tujuan()
    {
        return $this->hasOne(Pelabuhan::class, 'id','id_tujuan');
    }
    public function master()
    {
        return $this->hasOne(MasterKapal::class, 'IMO', 'IMO');
    }
}

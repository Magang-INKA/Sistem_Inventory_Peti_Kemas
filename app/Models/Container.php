<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kapal;
use App\Models\Pelabuhan;

class Container extends Model
{
    use HasFactory;
    protected $table="container"; // Eloquent akan membuat model Container menyimpan record di tabel container
    protected $primaryKey = 'id'; // Memanggil isi DB Dengan primarykey
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_kapal',
        'nama_container',
        'id_pelabuhan',
    ];

    public function kapal()
    {
        return $this->belongsTo(Kapal::class, 'id_kapal');
    }
    public function pelabuhan()
    {
        return $this->belongsTo(Pelabuhan::class, 'id_pelabuhan');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterKapal;
use App\Models\Pelabuhan;
use App\Models\MasterContainer;

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
        'no_container',
    ];

    public function kapal()
    {
        return $this->belongsTo(MasterKapal::class, 'id_kapal', 'id');
    }
    public function master()
    {
        return $this->belongsTo(MasterContainer::class, 'no_container');
    }

}

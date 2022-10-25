<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kapal;
use App\Models\Container;

class Pelabuhan extends Model
{
    use HasFactory;
    protected $table="pelabuhan"; // Eloquent akan membuat model Container menyimpan record di tabel container
    protected $primaryKey = 'id'; // Memanggil isi DB Dengan primarykey
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'id',
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
}

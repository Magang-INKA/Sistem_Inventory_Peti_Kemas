<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

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
        'kode_container',
        'nama_container',
        'keterangan',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class JenisBarang extends Model
{
    use HasFactory;
    protected $table = 'jenis_barang';
    protected $fillable = [
        'id',
        'jenis_barang',
        'suhu',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}

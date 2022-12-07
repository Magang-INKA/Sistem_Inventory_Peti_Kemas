<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelabuhan;

class DropPoint extends Model
{
    use HasFactory;
    protected $table="drop_point"; // Eloquent akan membuat model drop_point menyimpan record di tabel drop_point
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_transaksi',
        'pelabuhan',
        'keterangan',
        'created_at',
        'updated_at',
    ];

    public function pelabuhan()
    {
        return $this->belongsTo(Pelabuhan::class, 'pelabuhan');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterContainer extends Model
{
    use HasFactory;
    protected $table="master_container"; // Eloquent akan membuat model Container menyimpan record di tabel container
    protected $primaryKey = 'no_container'; // Memanggil isi DB Dengan primarykey
    public $incrementing =false;
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'no_container',
        'jenis',
        'ukuran',
    ];
}

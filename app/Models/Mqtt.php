<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mqtt extends Model
{
    use HasFactory;
    protected $table="mqtt";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'ts',
        'topic',
        'value',
        'qos',
        'retain',
        'history_enable',
        'history_diffonly',
    ];

    public function dashboard()
    {
        return $this->hasMany(Dashboard::class);
    }
}

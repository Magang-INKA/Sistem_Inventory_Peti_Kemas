<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    protected $table="mqtt_history";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'ts',
        'topicid',
        'value',
    ];

    public function mqtt()
    {
        return $this->belongsTo(Mqtt::class, 'topicid');
    }

    // public function getValueAttribute()
    // {
    //     return json_decode($this->fillable['value']);

    // }

}

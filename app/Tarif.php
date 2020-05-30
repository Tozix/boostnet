<?php

namespace BoostNet;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tarifs';
    public $timestamps = false;
    protected $fillable = [
        'name', 'cost', 'type', 'status', 'speed', 'description'
    ];
}

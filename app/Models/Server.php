<?php

namespace BoostNet\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = 'servers';
    public $timestamps = false;
    protected $fillable = [
        'name', 'domain', 'ip', 'city', 'speed', 'status', 'description'
    ];
}

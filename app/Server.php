<?php

namespace BoostNet;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = 'servers';
    public $timestamps = false;
    protected $fillable = [
        'domain', 'ip', 'city', 'num_users', 'speed', 'status', 'description'
    ];
}

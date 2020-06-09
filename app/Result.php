<?php

namespace BoostNet;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'user_id', 'server_id', 'ping','jitter','download','upload'
    ];

    public function user()
    {
        return $this->belongsTo('BoostNet\User');
    }
    public function server()
    {
        return $this->belongsTo('BoostNet\Server');
    }
}

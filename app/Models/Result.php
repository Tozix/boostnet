<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'user_id', 'server_id', 'ping', 'jitter', 'download', 'upload'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}

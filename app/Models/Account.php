<?php

namespace BoostNet\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'ip', 'name'
    ];
    protected $hidden = [
        'public_key', 'private_key'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

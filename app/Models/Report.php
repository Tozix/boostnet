<?php

namespace BoostNet\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id', 'type', 'title', 'description'
    ];
}

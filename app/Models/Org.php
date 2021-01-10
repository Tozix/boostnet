<?php

namespace BoostNet\Models;

use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    protected $table = 'orgprops';

    public $timestamps = false;
    protected $fillable = [
        'user_id', 'org_tel', 'org_email', 'org_name', 'org_inn', 'org_kpp', 'org_bik', 'org_rschet', 'org_korschet', 'org_bank', 'org_dir_fio', 'org_dir_dol', 'address_ur', 'address_fact', 'org_contacts'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

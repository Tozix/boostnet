<?php

namespace BoostNet;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use BoostNet\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','balance','tarif_id','active_vpn','type','server_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
    
    public function sendPasswordResetNotification($token)
    {
        // Добавляем свой класс.
        $this->notify(new ResetPassword($token));
    }
    public function tarif()
    {
        return $this->hasOne('BoostNet\Tarif', 'id', 'tarif_id');
    }
  
    public function tarif_list()
    {
        $list = Tarif::all();
        return $list;
    }
     public function accounts()
    {
        return $this->hasMany('BoostNet\Account');
    }
}

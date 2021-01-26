<?php

namespace App\Models;

use App\Permissions\HasPermissionsTrait;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
//use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;
    use HasPermissionsTrait; //Import The Trait
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'balance', 'tarif_id', 'active_vpn', 'type', 'server_id'
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
        return $this->hasOne(Tarif::class, 'id', 'tarif_id');
    }

    public function tarif_list()
    {
        $list = Tarif::all();
        return $list;
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
    //Профили пользователей для заказов
    /**
     * Связь «один ко многим» таблицы `users` с таблицей `profiles`
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}

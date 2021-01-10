<?php

namespace BoostNet\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Связь «один ко многим» таблицы `orders` с таблицей `order_items`
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'comment',
        'amount',
        'status',
    ];

    public const STATUSES = [
        0 => 'Новый',
        1 => 'Обработан',
        2 => 'Оплачен',
        3 => 'Доставлен',
        4 => 'Завершен',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Page extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'content',
        'parent_id',
    ];
    public function getRouteKeyName()
    {
        $current = Route::currentRouteName();
        if ('page.show' == $current) {
            return 'slug'; // мы в публичной части сайта
        }
        return 'id'; // мы в панели управления
    }
    /**
     * Связь «один ко многим» таблицы `pages` с таблицей `pages`
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    /**
     * Связь «страница принадлежит» таблицы `pages` с таблицей `pages`
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Page::class);
    }
}

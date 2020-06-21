<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// подключенный хелпер
use Illuminate\Support\Str;

class Category extends Model
{
    // Список с разрешенными полями для записи
    protected $fillable = ['title', 'slug', 'parent_id', 'published', 'created_by', 'modified_by'];

    // в поле slug будет автоматически формироваться уникальное значение из title
    // Для этого используются преобразователи - Mutators, исп. для преобразования значенния полей и других записей в базу
    // $value - полученное значение из формы или другого места
    public function setSlugAttribute($value) {
        // Обрезка поля title до 40 символов, генерация текущего воремени
        $this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40) . '-' . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }

    // Поиск вложенных категорий
    public function children() {
        return $this->hasMany(self::class, 'parent_id');
    }
}

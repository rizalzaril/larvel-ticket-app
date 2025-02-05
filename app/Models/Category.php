<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_name',
        'slug',
        'icon',
    ];


    public function setNameAttribute($value)
    {
        $this->attributes['category_name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }


    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}

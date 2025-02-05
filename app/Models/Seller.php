<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory as FactoriesHasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Seller extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'seller_name',
        'seller_email',
        'location',
        'slug',
        'photo',
    ];


    public function setNameAttribute($value)
    {
        $this->attributes['seller_name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}

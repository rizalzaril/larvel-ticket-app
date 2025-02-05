<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_tickets',
        'slug',
        'thumbnail',
        'path_video',
        'about',
        'price',
        'address',
        'is_popular',
        'open_time_at',
        'closed_time_at',
        'category_id',
        'seller_id',

    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name_tickets'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(TicketPhoto::class);
    }
}

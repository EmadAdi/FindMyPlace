<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Enums\PropertyStatus;
use App\Enums\PropertyType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes, InteractsWithMedia;
    protected $fillable = [
        'name',
        'type',
        'status',
        'area',
        'description',
        'governorate_id',
        'place_id',
        'price',
        'slug',
        'user_id',
        'bedroom_number',
        'bathroom_number',
        'has_kitchen',
        'has_pool',
        'has_garden',
        'has_living_room',
    ];

    protected $casts = [
        'type' => PropertyType::class,
        'status' => PropertyStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

   public function registerMediaCollections(): void
    {
    $this->addMediaCollection('images');
   }

}

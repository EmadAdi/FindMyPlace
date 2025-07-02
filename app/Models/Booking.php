<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
     use HasFactory;
     protected $fillable = ['user_id', 'property_id', 'start_time', 'end_time', 'total_price', 'status'];
     protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
        'status'     => BookingStatus::class,
    ];

    public function user()     { return $this->belongsTo(User::class); }
    public function property() { return $this->belongsTo(Property::class); }

    public function contractBooking()
    {
        return $this->hasOne(ContractBooking::class);
    }
}

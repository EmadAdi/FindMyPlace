<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ContractDuration;
use App\Enums\ContractStatus;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
      use HasFactory;
      use SoftDeletes;

    protected $fillable = ['user_id', 'property_id', 'contract_date', 'contract_status', 'contract_duration'];

    protected $casts = [
        'contract_date'      => 'datetime',
        'contract_status'    => ContractStatus::class,
        'contract_duration'  => ContractDuration::class,
    ]; 
    public function user()     { return $this->belongsTo(User::class); }
    public function property() { return $this->belongsTo(Property::class); }
    public function bookings()
    {
              return $this->belongsToMany(Booking::class, 'contract_booking')
                ->withPivot('price')
                ->withTimestamps();
    }
}

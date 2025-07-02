<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContractBooking extends Model
{
       use HasFactory;
     
    protected $table = 'contract_booking';

    protected $fillable = ['contract_id', 'booking_id', 'price'];

    public function contract() { return $this->belongsTo(Contract::class); }
    public function booking()  { return $this->belongsTo(Booking::class); }
}

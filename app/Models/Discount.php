<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    
    protected $fillable = ['property_id', 'discount_percentage', 'start_date', 'end_date'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}

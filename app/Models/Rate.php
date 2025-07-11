<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rate extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'property_id', 'rating_value', 'comment'];

    public function user()     { return $this->belongsTo(User::class); }
    public function property() { return $this->belongsTo(Property::class); }
}

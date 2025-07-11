<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'governorate_id'];

    public function governorate() { return $this->belongsTo(Governorate::class); }
    public function properties()  { return $this->hasMany(Property::class); }
}

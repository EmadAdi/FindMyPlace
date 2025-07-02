<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Governorate extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function places()     { return $this->hasMany(Place::class); }
    public function properties() { return $this->hasMany(Property::class); }
}

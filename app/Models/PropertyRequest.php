<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\PropertyRequestStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyRequest extends Model
{
    use HasFactory;
    protected $fillable = ['request_date', 'request_desc', 'user_id', 'status'];

    protected $casts = [
        'status' => PropertyRequestStatus::class,
        'request_date' => 'datetime',
    ];

    public function user() { return $this->belongsTo(User::class); }
}

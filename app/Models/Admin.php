<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
      use HasRoles;
     protected $guard = 'admin';
     protected $fillable = [
        'name',
        'email',
        'password',
    ];

     protected $hidden = [
        'password',
        'remember_token',
    ];
}

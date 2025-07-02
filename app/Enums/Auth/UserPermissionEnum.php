<?php

namespace App\Enums\Auth;

  enum UserPermissionEnum: string
{
   //Property 
    case VIEW_PROPERTIES = 'view-properties';
   //Booking 
    case VIEW_BOOKINGS = 'view-bookings';
    case CREATE_BOOKINGS = 'create-bookings';
    case CANCEL_BOOKINGS = 'cancel-bookings';

    public function guard(): string
    {
        return 'user';
    }
}


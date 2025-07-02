<?php

namespace App\Enums\Auth;

enum AdminPermissionEnum: string
{
   // Properties
    case VIEW_PROPERTIES       = 'View Properties';
    case CREATE_PROPERTIES     = 'Create Property';
    case EDIT_PROPERTIES       = 'Edit Property';
    case DELETE_PROPERTIES     = 'Delete Property';

    // Discounts
    case VIEW_DISCOUNTS        = 'View Discounts';
    case CREATE_DISCOUNTS      = 'Create Discount';
    case EDIT_DISCOUNTS        = 'Edit Discount';
    case DELETE_DISCOUNTS      = 'Delete Discount';

    // Users
    case VIEW_USERS            = 'View Users';
    case DELETE_USERS          = 'Delete Users';
    case RESTORE_USERS         = 'Restore Users';

    // Bookings
    case VIEW_BOOKINGS         = 'View Bookings';
    case UPDATESTATUS_BOOKING  = 'Update Booking Status';

    // Property Requests
    case VIEW_PROPERTYREQUESTS     = 'View Requests';
    case APPROVE_PROPERTYREQUESTS  = 'Approve Request';
    case REJECT_PROPERTYREQUESTS   = 'Reject Request';

    //Contract
    case VIEW_CONTRACTS   = 'View Contracts';
    case CREATE_CONTRACTS = 'Create Contract';
    case EDIT_CONTRACTS   = 'Edit Contract';
    case DELETE_CONTRACTS = 'Delete Contract';

    //Governorate 
    case VIEW_GOVERNORATES = 'View governorates';
    case CREATE_GOVERNORATES = 'Create governorates';
    case EDIT_GOVERNORATES = 'Edit governorates';
    case DELETE_GOVERNORATES = 'Delete governorates';

    //Place
    case VIEW_PLACES = 'View places';
    case CREATE_PLACES = 'Create places';
    case EDIT_PLACES = 'Edit places';
    case DELETE_PLACES = 'Delete places';

    public function guard(): string
    {
        return 'admin';
    }
}


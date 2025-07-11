<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth:admin', 'verified']);
    }

    public function index()
   {
       return view('admin.dashboard', [
        'usersCount' => User::count(),
        'propertiesCount' => Property::count(),
        'contractsCount' => Contract::count(),
        'bookingsCount' => Booking::count(),
       ]);
   }
}

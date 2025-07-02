<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\BookingStatus;
use App\Models\Booking;

class BookingController extends Controller
{
       public function __construct()
    {
        $this->middleware('permission:عرض الحجوزات')->only(['index']);
        $this->middleware('permission:تحديث حالة الحجز')->only(['updateStatus']);
    }

    public function index()
    {
        $bookings = Booking::with(['user', 'property'])->latest()->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_column(BookingStatus::cases(), 'value')),
        ]);

        $booking->update(['status' => $request->status]);

        return back()->with('success', 'تم تحديث حالة الحجز بنجاح');
    }
}

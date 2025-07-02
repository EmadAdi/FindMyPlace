<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Services\BookingService;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Events\BookingCreated;
use App\Events\BookingUpdated;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected BookingService $service;

    public function __construct(BookingService $service)
    {
        $this->service = $service;
    }

    // عرض الحجوزات للمستخدم الحالي
    public function index()
    {
        $bookings = Booking::with('property')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.bookings.index', compact('bookings'));
    }

    // إنشاء حجز جديد
    public function store(StoreBookingRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();

            $booking = $this->service->create($data);

            event(new BookingCreated($booking));

            return redirect()->route('user.bookings.index')->with('success', 'تم إنشاء الحجز بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // تحديث حالة الحجز فقط
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        try {
            $booking = $this->service->update($booking, $request->validated());

            event(new BookingUpdated($booking));

            return back()->with('success', 'تم تحديث الحجز.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // حذف الحجز
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        $this->authorize('delete', $booking);

        try {
            $this->service->deleteById($id);

            return back()->with('success', 'تم حذف الحجز بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

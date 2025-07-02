<?php
namespace App\Services;

use App\Models\Booking;
use App\Enums\BookingStatus;

class BookingService
{
    public function create(array $data): Booking
    {
        if ($this->hasOverlapping($data)) {
            throw new \Exception('هذا العقار محجوز في الفترة المحددة.');
        }

        $data['booking_status'] = BookingStatus::from($data['booking_status']);
        return Booking::create($data);
    }

    public function update(Booking $booking, array $data): Booking
    {
        if ($this->hasOverlapping($data, $booking->id)) {
            throw new \Exception('تداخل في المواعيد مع حجز آخر.');
        }

        if (isset($data['booking_status'])) {
            $data['booking_status'] = BookingStatus::from($data['booking_status']);
        }

        $booking->update($data);
        return $booking;
    }
public function deleteById($id): void
{
    $booking = Booking::findOrFail($id);
    $booking->delete(); // حذف دائم
}




    private function hasOverlapping(array $data, ?int $excludeId = null): bool
    {
        return Booking::where('property_id', $data['property_id'])
            ->where('booking_status', '!=', 'canceled')
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->where(function ($q) use ($data) {
                $q->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                  ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']])
                  ->orWhere(function ($q2) use ($data) {
                      $q2->where('start_time', '<=', $data['start_time'])
                         ->where('end_time', '>=', $data['end_time']);
                  });
            })
            ->exists();
    }
}


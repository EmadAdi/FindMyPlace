<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\BookingCreated;
use App\Events\BookingUpdated;
use Illuminate\Support\Facades\Log;

class SendBookingNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        
        Log::info('Booking event fired:', ['booking_id' => $event->booking->id]);
        // ممكن ترسل إشعار أو بريد هنا لاحقًا
    }
}

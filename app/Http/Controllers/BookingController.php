<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'workspace_id' => 'required|exists:workspaces,id',
            'booking_date_time' => 'required|date|after:now',
        ]);

        $bookingExists = Booking::where('workspace_id', $request->workspace_id)
            ->where('booking_date_time', $request->booking_date_time)
            ->exists();

        if ($bookingExists) {
            return back()->withErrors(['error' => 'The workspace is already booked at this time.']);
        }

        Booking::create([
            'user_id' => auth()->id(),
            'workspace_id' => $request->workspace_id,
            'booking_date_time' => $request->booking_date_time,
            'status' => 'Pending',
        ]);

        return redirect()->route('bookings.index');
    }

    public function updateStatus(Request $request, $id) {
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('bookings.index');
    }
}

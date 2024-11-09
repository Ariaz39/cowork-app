<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::all();

        if (auth()->user()->role === 'adm') {
            $bookings = Booking::with('workspace', 'user')->get();
        } else {
            $bookings = Booking::where('user_id', Auth::id())->with('workspace')->get();
        }

        return view('bookings.index', compact('bookings', 'workspaces'));
    }

    public function create()
    {
        $workspaces = Workspace::all();
        return view('bookings.create', compact('workspaces'));
    }

    public function store(StoreBookingRequest $request)
    {
        $existingBooking = Booking::where('workspace_id', $request->workspace_id)
            ->where('booking_date_time', $request->booking_date_time)
            ->exists();

        if ($existingBooking) {
            return back()->withErrors(['booking_date_time' => 'This workspace is already booked at the selected time.']);
        }

        Booking::create([
            'workspace_id' => $request->workspace_id,
            'user_id' => Auth::id(),
            'booking_date_time' => $request->booking_date_time,
            'status' => 'Pending',
        ]);

        return redirect()->route('booking.index')
            ->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);
        return view('bookings.edit', compact('booking'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $booking->update($request->only('status'));

        return redirect()->route('booking.index')
            ->with('success', 'Estado de la reserva actualizado exitosamente.');
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('workspaces')->get();
        return view('bookings.my_bookings', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected',
        ]);

        $booking->update([
            'status' => $request->status,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully.');
    }

}

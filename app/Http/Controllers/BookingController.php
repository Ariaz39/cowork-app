<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Muestra una lista de todas las reservas (para los administradores).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Recuperar todos los workspaces
        $workspaces = Workspace::all();

        if(auth()->user()->role === 'adm') {
            // Si el usuario es admin, mostrar todas las reservas
            $bookings = Booking::with('workspace', 'user')->get();
        } else {
            // Si el usuario es regular, mostrar solo las reservas que le pertenecen
            $bookings = Booking::where('user_id', Auth::id())->with('workspace')->get();
        }

        // Pasar las reservas y workspaces a la vista
        return view('bookings.index', compact('bookings', 'workspaces'));
    }


    /**
     * Muestra el formulario para crear una nueva reserva.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $workspaces = Workspace::all();
        return view('bookings.create', compact('workspaces'));
    }

    /**
     * Guarda una nueva reserva en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'workspace_id' => 'required|exists:workspaces,id',
            'booking_date_time' => 'required|date|after:now',
        ]);

        // Verificar disponibilidad de la sala
        $existingBooking = Booking::where('workspace_id', $request->workspace_id)
            ->where('booking_date_time', $request->booking_date_time)
            ->exists();

        if ($existingBooking) {
            return back()->withErrors(['booking_date_time' => 'This workspaces is already booked at the selected time.']);
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

    /**
     * Muestra el formulario para editar el estado de una reserva (para administradores).
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\View\View
     */
    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking); // Autorizar solo para administradores
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Actualiza el estado de una reserva.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking); // Autorizar solo para administradores

        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected',
        ]);

        $booking->update([
            'status' => $request->status,
        ]);

        return redirect()->route('booking.index')
            ->with('success', 'Booking status updated successfully.');
    }

    /**
     * Muestra las reservas del usuario autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('workspaces')->get();
        return view('bookings.my_bookings', compact('bookings'));
    }

    /**
     * Actualiza el estado de una reserva.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $bookingId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Booking $booking)
    {
        // Validar el estado
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected',
        ]);

        // Actualizar el estado de la reserva
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

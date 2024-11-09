@extends('layouts.app')

@section('content')
    <h1>Bookings</h1>

    <!-- Listado de reservas para el cliente o administrador -->
    <ul>
        @foreach($bookings as $booking)
            <li>{{ $booking->workspace->name }} - {{ $booking->booking_date_time }} - Status: {{ $booking->status }}</li>
            @if(auth()->user()->role === 'admin')
                <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status">
                        <option value="Accepted">Accepted</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                    <button type="submit">Update Status</button>
                </form>
            @endif
        @endforeach
    </ul>
@endsection

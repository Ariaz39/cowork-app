@extends('layouts.app')

@section('content')
    <h1>New Booking</h1>

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <label for="workspace_id">Workspace:</label>
        <select name="workspace_id" required>
            @foreach($workspaces as $workspace)
                <option value="{{ $workspace->id }}">{{ $workspace->name }}</option>
            @endforeach
        </select>

        <label for="booking_date_time">Date and Time:</label>
        <input type="datetime-local" name="booking_date_time" required>

        <button type="submit">Book Now</button>
    </form>
@endsection

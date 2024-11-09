@extends('layouts.app')

@section('content')
    @if(auth()->user()->role === 'usr')
        <div class="bg-white p-6 rounded-lg shadow-md mb-6 mt-3">
            <h2 class="text-xl font-semibold mb-4">Create a New Booking</h2>
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="workspace_id" class="block text-sm font-medium text-gray-700">Workspace</label>
                        <select name="workspace_id" id="workspace_id" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Select a Workspace</option>
                            @foreach($workspaces as $workspace)
                                <option value="{{ $workspace->id }}">{{ $workspace->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="booking_date_time" class="block text-sm font-medium text-gray-700">Booking Date and Time</label>
                        <input type="datetime-local" name="booking_date_time" id="booking_date_time" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-lg shadow-lg border border-gray-400 transition-colors duration-200 mt-3">
                        Create Booking
                    </button>
                </div>
            </form>
        </div>
    @endif

    <ul class="space-y-4">
        @foreach($bookings as $booking)
            <li class="bg-white p-4 rounded-lg shadow-md mt-3">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-700 font-semibold">{{ $booking->workspace->name }}</p>
                        <p class="text-sm text-gray-500">Date: {{ $booking->booking_date_time }}</p>

                        @if($booking->status === 'Pending')
                            <p class="text-sm text-yellow-500">Status: <span class="font-bold">{{ $booking->status }}</span></p>
                        @elseif($booking->status === 'Accepted')
                            <p class="text-sm text-green-500">Status: <span class="font-bold">{{ $booking->status }}</span></p>
                        @elseif($booking->status === 'Rejected')
                            <p class="text-sm text-red-500">Status: <span class="font-bold">{{ $booking->status }}</span></p>
                        @endif

                        <p class="text-sm text-gray-500">User: <span class="font-semibold">{{ $booking->user->name }}</span></p>
                        <p class="text-sm text-gray-500">Email: <span class="font-semibold">{{ $booking->user->email }}</span></p>
                    </div>

                    <div class="flex-shrink-0">
                        @if(auth()->user()->role === 'adm')
                            <form action="{{ route('booking.updateStatus', $booking->id) }}" method="POST" class="booking-status-form" data-booking-id="{{ $booking->id }}">
                                @csrf
                                @method('PATCH')

                                <div class="flex items-center space-x-3">
                                    <select name="status" class="status-select w-32 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="Pending" {{ $booking->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Accepted" {{ $booking->status === 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="Rejected" {{ $booking->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>

                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition-colors duration-200 hidden">
                                        Update Status
                                    </button>
                                </div>
                            </form>
                        @elseif(auth()->user()->role === 'usr')
                            <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400 transition-colors duration-200">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('.status-select').on('change', function () {
                var status = $(this).val();
                var bookingId = $(this).closest('form').data('booking-id');

                $.ajax({
                    url: '{{ route('booking.updateStatus', ['booking' => 'BOOKING_ID']) }}'.replace('BOOKING_ID', bookingId),
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success('Booking status updated successfully.');
                        } else {
                            toastr.error('Failed to update the booking status.');
                        }
                    },
                    error: function (response) {
                        toastr.error('Error while updating status.');
                    }
                });
            });
        });
    </script>

@endsection

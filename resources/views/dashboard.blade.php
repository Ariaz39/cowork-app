@extends('layouts.app')

@section('content')
    <!-- Contenedor principal con dos tarjetas distribuidas en 2/3 y 1/3 -->
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="flex w-full max-w-7xl space-x-8">

            <!-- Tarjeta de Bienvenida (2/3 de la pantalla) -->
            <div class="w-2/3 bg-white p-6 rounded-lg shadow-lg text-center">
                <!-- Imagen de bienvenida -->
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/welcome.png') }}" alt="Imagen de Coworking" class="rounded-md">
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Bienvenido a la aplicación de reservas de coworking</h1>
                <p class="text-gray-600">¡Gestiona tus reservas de espacios de coworking de manera fácil y rápida!</p>
            </div>

            <!-- Tarjeta de Botones (1/3 de la pantalla) -->
            <div class="w-1/3">
                <!-- Mostrar solo si el rol del usuario es 'adm' -->
                @if(auth()->user()->role === 'adm')
                    <!-- Tarjeta de Workspaces -->
                    <div class="bg-white p-6 rounded-lg shadow-lg mb-4 cursor-pointer hover:bg-gray-100 transition duration-200">
                        <div class="flex items-center">
                            <i class="fas fa-building text-2xl text-blue-500 mr-4"></i> <!-- Icono de workspace -->
                            <a href="{{ route('workspace.index') }}" class="text-xl font-semibold text-gray-800">Acceder a Workspaces</a>
                        </div>
                    </div>
                @endif

                <!-- Tarjeta de Bookings -->
                <div class="bg-white p-6 rounded-lg shadow-lg cursor-pointer hover:bg-gray-100 transition duration-200">
                    <div class="flex items-center">
                        <i class="fas fa-calendar-check text-2xl text-green-500 mr-4"></i> <!-- Icono de booking -->
                        <a href="{{ route('booking.index') }}" class="text-xl font-semibold text-gray-800">Acceder a Reservas</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <!-- CDN de FontAwesome para los íconos -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush

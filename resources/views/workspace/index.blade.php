@extends('layouts.app')

@section('content')
    <h1>Workspaces</h1>

    <!-- Formulario para crear una nueva sala -->
    <form action="{{ route('workspaces.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Workspace Name" required>
        <textarea name="description" placeholder="Description"></textarea>
        <button type="submit">Add Workspace</button>
    </form>

    <!-- Listado de salas -->
    <ul>
        @foreach($workspaces as $workspace)
            <li>{{ $workspace->name }} - {{ $workspace->description }}</li>
        @endforeach
    </ul>
@endsection

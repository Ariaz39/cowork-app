@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">

        <!-- Formulario para editar la sala -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Edit Workspace</h2>
            <form action="{{ route('workspace.update', $workspace->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-gray-600">Workspace Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Workspace Name"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('name', $workspace->name) }}"
                        required
                    >
                </div>
                <div>
                    <label for="description" class="block text-gray-600">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        placeholder="Description"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >{{ old('description', $workspace->description) }}</textarea>
                </div>
                <button
                    type="submit"
                    class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-lg shadow-lg border border-gray-400 transition-colors duration-200"
                >
                    Update Workspace
                </button>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">

        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Add New Workspace</h2>
            <form action="{{ route('workspace.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-gray-600">Workspace Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Workspace Name"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
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
                    ></textarea>
                </div>
                <button
                    type="submit"
                    class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-lg shadow-lg border border-gray-400 transition-colors duration-200"
                >
                    Add Workspace
                </button>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mt-3">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Workspace List</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">ID</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Name</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Description</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($workspaces as $workspace)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b text-gray-700">{{ $workspace->id }}</td>
                            <td class="py-2 px-4 border-b text-gray-700">{{ $workspace->name }}</td>
                            <td class="py-2 px-4 border-b text-gray-700">{{ $workspace->description }}</td>
                            <td class="py-2 px-4 border-b text-gray-700">
                                <div class="flex space-x-2">
                                    <a href="{{ route('workspace.edit', $workspace->id) }}"
                                       class="bg-gray-800 hover:bg-gray-900 text-white py-1 px-3 rounded-md text-sm font-semibold">
                                        Edit
                                    </a>
                                    <form action="{{ route('workspace.destroy', $workspace->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md text-sm font-semibold">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    /**
     * Muestra la lista de workspaces.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $workspaces = Workspace::all();
        return view('workspaces.index', compact('workspaces'));
    }

    /**
     * Muestra el formulario para crear un nuevo workspaces.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('workspaces.index');
    }

    /**
     * Guarda un nuevo workspaces en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Workspace::create($request->only('name', 'description'));

        return redirect()->route('workspace.index')
            ->with('success', 'Workspace created successfully.');
    }

    /**
     * Muestra el formulario para editar un workspaces existente.
     *
     * @param  \App\Models\Workspace  $workspace
     * @return \Illuminate\View\View
     */
    public function edit(Workspace $workspace)
    {
        return view('workspaces.edit', compact('workspace'));
    }

    /**
     * Actualiza el workspaces en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workspace  $workspace
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Workspace $workspace)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $workspace->update($request->only('name', 'description'));

        return redirect()->route('workspace.index')
            ->with('success', 'Workspace updated successfully.');
    }

    /**
     * Elimina el workspaces de la base de datos.
     *
     * @param  \App\Models\Workspace  $workspace
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Workspace $workspace)
    {
        $workspace->delete();

        return redirect()->route('workspace.index')
            ->with('success', 'Workspace deleted successfully.');
    }
}

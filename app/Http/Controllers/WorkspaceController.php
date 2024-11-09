<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkspaceRequest;
use App\Models\Workspace;

class WorkspaceController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::all();
        return view('workspaces.index', compact('workspaces'));
    }

    public function create()
    {
        return view('workspaces.index');
    }

    public function store(StoreWorkspaceRequest $request)
    {
        Workspace::create($request->only('name', 'description'));

        return redirect()->route('workspace.index')
            ->with('success', 'Workspace created successfully.');
    }

    public function edit(Workspace $workspace)
    {
        return view('workspaces.edit', compact('workspace'));
    }

    public function update(UpdateWorkspaceRequest $request, Workspace $workspace)
    {
        $workspace->update($request->only('name', 'description'));

        return redirect()->route('workspace.index')
            ->with('success', 'Workspace updated successfully.');
    }

    public function destroy(Workspace $workspace)
    {
        $workspace->delete();

        return redirect()->route('workspace.index')
            ->with('success', 'Workspace deleted successfully.');
    }
}

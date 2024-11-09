<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    public function index() {
        $workspaces = Workspace::all();
        return view('workspaces.index', compact('workspaces'));
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required']);
        Workspace::create($request->all());
        return redirect()->route('workspaces.index');
    }
}

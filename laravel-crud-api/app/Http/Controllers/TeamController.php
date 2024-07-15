<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Teams;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        return Teams::all();
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $team = Teams::create($validated);

        return response()->json($team, 201);
    }

    // Display the specified resource.
    public function show($id)
    {
        $team = Teams::findOrFail($id);
        return $team;
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $team = Teams::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $team->update($validated);

        return response()->json($team, 200);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $team = Teams::findOrFail($id);
        $team->delete();

        return response()->json(null, 204);
    }
}
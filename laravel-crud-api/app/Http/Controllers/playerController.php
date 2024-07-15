<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
    //display a listing of the resource. return json == GET ALL
    public function index()
    {
        $players = Player::all();
        return response()->json($players);
    }

    //store a newly created resource in storage ==CREATE
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => 'required|string',
            "email" => 'required|string'
        ]);

        $player = Player::create($validatedData);

        return response()->json($player, 201);
    }

    //display the specified resource
    public function show(Player $player)
    {
        return response()->json($player);
    }

    //update the specified resource
    public function update(Request $request, Player $player)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string'
        ]);

        $player->update($validatedData);
        return response()->json($player, 0);
    }

    //remove the specified resource
    public function destroy(Player $player)
    {
        $player->delete();
        return response()->json(null, 204);
    }
}
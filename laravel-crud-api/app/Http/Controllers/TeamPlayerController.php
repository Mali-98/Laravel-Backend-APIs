<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Teams;
use Illuminate\Http\Request;

class TeamPlayerController extends Controller
{
    // Add a player to a team
    public function addPlayerToTeam(Request $request, $teamId)
    {
        $team = Teams::findOrFail($teamId);
        $playerId = $request->input('player_id');

        $team->players()->attach($playerId);

        return response()->json(['message' => 'Player added to team successfully'], 201);
    }

    // Add existing player to a team
    // public function addExistingPlayerToTeam($teamId, $playerId)
    // {
    //     $team = Teams::findOrFail($teamId);
    //     $player = Player::findOrFail($playerId);

    //     // Check if the player already exists in the team
    //     if ($team->players()->where('player_id', $playerId)->exists()) {
    //         return response()->json(['message' => 'Player already belongs to this team'], 409);
    //     }

    //     $team->players()->attach($playerId);

    //     return response()->json(['message' => 'Player added to team successfully'], 201);
    // }

    // Remove a player from a team
    public function removePlayerFromTeam($teamId, $playerId)
    {
        $team = Teams::findOrFail($teamId);

        $team->players()->detach($playerId);

        return response()->json(['message' => 'Player removed from team successfully'], 200);
    }

    // Get all players in a team
    public function getPlayersInTeam($teamId)
    {
        $team = Teams::findOrFail($teamId);
        $players = $team->players;

        return response()->json($players, 200);
    }

    // Get all teams a player is part of
    public function getTeamsForPlayer($playerId)
    {
        $player = Player::findOrFail($playerId);
        $teams = $player->teams;

        return response()->json($teams, 200);
    }
}
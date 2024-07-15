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
        $playerIds = $request->input('player_ids', []);

        // Validate the player IDs
        foreach ($playerIds as $playerId) {
            $player = Player::find($playerId);
            if (!$player) {
                return response()->json(['message' => "Player with ID $playerId does not exist"], 404);
            }
        }

        // Attach each player to the team
        $team->players()->syncWithoutDetaching($playerIds);

        return response()->json(['message' => 'Players added to team successfully'], 201);
    }

    // Remove a player from a team
    public function removePlayerFromTeam(Request $request, $teamId)
    {
        $team = Teams::findOrFail($teamId);
        $playerIds = $request->input('player_ids', []);

        // Validate and detach the player IDs
        foreach ($playerIds as $playerId) {
            // Check if the player is associated with the team
            if (!$team->players()->where('player_id', $playerId)->exists()) {
                return response()->json(['message' => "Player with ID $playerId is not part of this team"], 404);
            }
        }

        // Detach the players from the team
        $team->players()->detach($playerIds);

        return response()->json(['message' => 'Players removed from team successfully'], 200);
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